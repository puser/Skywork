/*
   jQuery Text Annotate Plugin 0.96
   Copyright (C) 2011-2012  Koos van der Kolk (koosvdkolk [at] gmail.com)

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
(function($){
  jQuery.fn.textAnnotate = function(){
    var main_element = jQuery(this);
		
    /* init some variables */
    var options                   = main_element.data("textAnnotate.options") || {};
    
    var global_annotations        = main_element.data("textAnnotate.global_annotations") || {};
    		
    var textAnnotaterOn = false;
    var textHiglighterOnAction;
    var annotatableElementCounter=0;
    var indexesOfAnnotationsWithFocus;
    var beingAnnotatedElementIdArray = [];
    var formElement;
    var userDialog;

    switch (arguments[0]){
      /* Public functions */

      case "getAnnotations":
        return global_annotations;
        break;

      case "addAnnotations":
        var annotations = arguments[1];        
        loadAnnotations(annotations);
        break;

	  case "saveAndClose":
//	console.log('11');
//		console.log(indexesOfAnnotationsWithFocus);
//		saveAnnotationFormWithFocus();
//		hideUserDialog();
		break;

      case "saveForm":
        var annotationId = arguments[1];
        var targetElement = jQuery(arguments[2]);
        var serializedForm = arguments[3];

        saveElementForm(annotationId, targetElement, serializedForm);


      case 'bind':
        var listeners                 = main_element.data("textAnnotate.listeners")
        if (!listeners){
          listeners = {
            "addannotation":[],
            "removeannotation":[],
            "saveform":[],
            "beforeshowdialog":[],
            "beforehidedialog": []
          };
        }
    
        var type = arguments[1].toString().toLowerCase();
        var listener = arguments[2];
       
        if (listeners[type] == undefined){
          alert('Listener ' + type + ' is not defined!');
          return;
        }
        listeners[type].push(listener);

        main_element.data("textAnnotate.listeners", listeners);
        break;


      default:
        options = arguments[0];
				
        //css and ids
        options.annotatedClassName       = options.annotatedClassName || "annotated";
        options.beingAnnotatedClassName  = options.beingAnnotatedClassName || "beingAnnotated";
        options.wrapperClassName         = options.wrapperClassName || "textAnnotateWrapper";
        options.elementClassName         = options.elementClassName || "annotatableElement";
        options.annotationFocusClassName = options.annotationFocusClassName || "annotationFocus";
        options.elementIdPrefix          = options.elementIdPrefix  || "textAnnotate_";

        options.form                     = options.form ||{};
        //form
        options.formDeleteAnnotationButton = options.formDeleteAnnotationButton || '<a href="javascript:void(0)" class="jQueryTextAnnotaterDialogRemoveButton">Remove annotation</a>';

        /* init */
        _init(main_element);
        break;
    }

    /**
     * Init the annotater
     * @param jQueryElement
     *  A jQueried DOM element
     **/
    function _init(jQueryElement){
      var i;

      /* store options */
      main_element.data("textAnnotate.options", options);

      /* add event to body, ending all annotateing activities */
      $('body').mouseup(function(){
        onAnnotateEnd();
      });

      /* create user dialog */
      userDialog                    = $('<div class="jQueryTextAnnotaterDialog"></div>');

      //set annotatin focus when hovering (probably user does not want the
      //annotation focus to be gone when hovering the dialog)
      userDialog.hover(function(){
        var element = userDialog.data('textAnnotate.element');
        if (element){
          setElementAnnotationFocus(element);
        }
      });

      //remove annotation focus when leaving the dialog
      userDialog.mouseleave(function(){
        userDialog.removeData('element');
        removeAnnotationFocus();
      })

      //add button to dialog
      var userDialogRemoveAnnotationButton = $(options.formDeleteAnnotationButton);
      userDialogRemoveAnnotationButton.click(function(){
        textHiglighterOnAction = '';
        removeAnnotationWithFocus();
      });

      userDialog.append(userDialogRemoveAnnotationButton);

      //add form to dialog
      if (options.form){
        formElement = $('<form class="jQueryTextAnnotaterDialogForm"></form>');
        formElement.html(options.form);

        //when form element value changes, save the form
        formElement.find(':input').click(function(){
          saveAnnotationFormWithFocus();
        }).keyup(function(){
          saveAnnotationFormWithFocus();
        });
      }
      userDialog.append(formElement);
      _enableTextSelect(userDialog);

      $('body').append(userDialog);
			
      /* disable text selection */
      _disableTextSelect(jQueryElement);

      /* put all elements to which this function is called into _initElements
         function
      */
      for (i=0; i<jQueryElement.length; i++){
        _initElements(jQueryElement[i]);

        $(jQueryElement[i]).mousedown(function(){
          onAnnotateStart(this);
        });
      }
	
      $("."+options.elementClassName, jQueryElement).mousedown(function(){
        if($(this).attr('class').indexOf(options.annotatedClassName)===-1){
          textHiglighterOnAction = 'add';
          addHighlight(this);
        }
      });
		
      $("."+options.elementClassName, jQueryElement).mouseover(function(){
        var element = $(this);
        if (textAnnotaterOn){
          if (textHiglighterOnAction==='add'){
            addHighlight(element);
          } else if (textHiglighterOnAction==='remove'){
            removeElementAnnotation(element, indexesOfAnnotationsWithFocus);
          }
        } else if(element.data('textAnnotate.annotationIndexes') && element.data('textAnnotate.annotationIndexes').length>0){
          setElementAnnotationFocus(element);
        }
      });
		
      $("."+options.elementClassName, jQueryElement).mouseout(function(){
        removeAnnotationFocus();
      });

      /* store global annotations */
      main_element.data("textAnnotate.global_annotations", global_annotations);

      //call listener
      notifyListeners('init', global_annotations)
    }

    /**
     * Loads annotations
     * @param annotationDefinitions
     *  Object
     *   {"annotationId" :
     *    [
     *      {"elementId":id,
     *       "formValues":dataObj
     *      }
     *    ]}
     *    In which dataObj ={key: value, ...}
     * @param useAnnotationIndex
     *  Boolean, when true (default), the 'annotationId' in the
     *    annotationDefinitions is used as the id of the newly created
     *    annotations;
     **/
    function loadAnnotations(annotationDefinitions, useAnnotationIndex){
      var annotationId, elements;
      useAnnotationIndex = useAnnotationIndex || true;

      for (annotationId in annotationDefinitions){
        elements = annotationDefinitions[annotationId];
        if (useAnnotationIndex){
          addAnnotation(elements, annotationId);
        }else{
          addAnnotation(elements);
        }
      }
    }

    /**
     * Adds an annotation
     * @param elements
     *   A jQuery array-like object with elements OR an array with annotation
     *     definitions (see function loadAnnotations)
     * @param annotationId
     *   (optional) the annotationId
     **/
    function addAnnotation(elements, annotationId){
      
      var element, elementDefinitionsProvided = false, newAnnotateLevel, currentAnnotateLevel;
      var elementDefinition, elementId, elementData, dataKey, elementIndex, dataToStore, key, pos;
      if ($.isArray(elements)){
        /* we have an array of element definitions, see function loadAnnotations */
        elementDefinitionsProvided = true;
      }
      var annotationsCounter = main_element.data("textAnnotate.annotationsCounter") || 0;

      /* create new annotation */
      var annotation ={};

      //store annotation
      annotation = [];
      
      if (!annotationId) {
        annotationId = annotationsCounter
      }else{
        annotationId = parseInt(annotationId);
      }
      global_annotations[annotationId] = annotation;
			
      /* add elements to annotation */
      $(elements).each(function(index, value){
        if (elementDefinitionsProvided){
          /*
           we have an array of element definitions, see function
           loadAnnotations
          */
          elementDefinition = value;

          element = $('#'+elementDefinition.elementId);
          element.data('textAnnotate.formValues', elementDefinition.formValues);
        }else{
          /* we have an element collection */
          element = $(value);
        }

        /* remove beingAnnotated flag (if present) */
        element.data('textAnnotate.beingAnnotated', false);

        /* give it the correct class */
        element.removeClass(options.beingAnnotatedClassName);
        element.addClass(options.annotatedClassName);

        //add annotation level & class
        currentAnnotateLevel = element.attr('annotateLevel');
        if (currentAnnotateLevel===undefined){
          newAnnotateLevel = 0;
        } else{
          newAnnotateLevel = parseInt(currentAnnotateLevel, 10) + 1;
        }
				
        element.attr('annotateLevel', newAnnotateLevel);


        /* keep reference to annotation */
        if (element.data('textAnnotate.annotationIndexes')===undefined){
          element.data('textAnnotate.annotationIndexes', []);
        }
        $.merge(element.data('textAnnotate.annotationIndexes'), [annotationId]);

        /* add the element to annotation */
        elementIndex = annotation.length
        annotation[elementIndex] ={
          "elementId": element.attr('id'),
          "formValues": element.data('textAnnotate.formValues')
        };
      });
			

      //notify listeners
      notifyListeners('addAnnotation', annotation);

      main_element.data("textAnnotate.annotationsCounter", annotationsCounter+1);
      
      //return
      return annotation;
    }
	
    /**
     * This function prepares an element for annotateing
     * @param currentElement
     *   A DOM node
     * @credits
     *   Based on JQuery Plugin by Simon Chong
     *    (http://www.opensource.csimon.info/JQueryTextHighlighter/index.php)
     **/
    function _initElements(currentElement){
      var i, wordCounter, whiteSpaceTextNode, characterCounter, newImage, textnode, newElement, wrapperElement, words;

      /* put all words within childnodes of currentElement in <span>-tags (assumption: words are separated by whitespaces) */
      for ( i = 0; i < currentElement.childNodes.length; i++){
        var currentChildnode = currentElement.childNodes[i];

        if (currentChildnode.nodeType === 3){
					
          var currentChildnodeData = currentChildnode.data;
					
          //skip empty childnodes
          if (_trim(currentChildnodeData).length < 1){
            continue;
          }
			
          if (options.annotateCharacters === true) {
            //get characters within childnode             
            words = currentChildnodeData.split(/\s/);
			
            //create span wrapping
            wrapperElement = $('<span class="'+options.wrapperClassName+'"></span>');

            //loop over characters and put them in another span
            for (characterCounter = 0; characterCounter < currentChildnodeData.length; characterCounter++){
              textnode = currentChildnodeData.charAt(characterCounter);
              if (textnode.length==0) continue;
              if (textnode === ' ') {
                textnode = '&nbsp;';
              }
						
              newElement = $('<span class="'+options.elementClassName+'"></span>');
              newElement.attr('id', options.elementIdPrefix+annotatableElementCounter);
              newElement.data('textAnnotate.annotaterId', annotatableElementCounter);
					
              
              newElement.append(textnode);
              wrapperElement.append(newElement);
					
              //keep whitespaces in text
              if (textnode == '&nbsp;'){
                whiteSpaceTextNode = document.createTextNode(" ");
                wrapperElement.append(whiteSpaceTextNode);
              }
              annotatableElementCounter++;
            }
            $(currentChildnode).replaceWith(wrapperElement);           
          } else {
            //get words within childnode
            words = currentChildnodeData.split(/\s/);
			
            //create span wrapping
            wrapperElement = $('<span class="'+options.wrapperClassName+'"></span>');

            //loop over words and put them in another span
            for (wordCounter = 0; wordCounter < words.length; wordCounter++){
              textnode = document.createTextNode(words[wordCounter]);
              if (textnode.length==0) continue;
						
              newElement = $('<span class="'+options.elementClassName+'"></span>');
              newElement.attr('id', options.elementIdPrefix+annotatableElementCounter);
              newElement.data('textAnnotate.annotaterId', annotatableElementCounter);
					
              var whiteSpaceTextNode = document.createTextNode(" ");
              newElement.append(textnode);
              wrapperElement.append(newElement);
					
              //keep whitespaces in text
              if (wordCounter + 1 !== words.length || currentChildnodeData[currentChildnodeData.length - 1] === " "){
                wrapperElement.append(whiteSpaceTextNode);
              }
              annotatableElementCounter++;
            }
            $(currentChildnode).replaceWith(wrapperElement);
          }
        } else if (currentChildnode.nodeType ===1 && currentChildnode.nodeName==='IMG'){
          /* images */
          newImage = $(currentChildnode).clone();

          newElement = $('<span class="'+options.elementClassName+'"></span>');
          newElement.attr('id', options.elementIdPrefix+annotatableElementCounter);
          newElement.data('textAnnotate.annotaterId', annotatableElementCounter);
          newElement.append(newImage);
          $(currentChildnode).replaceWith(newElement);
					
          annotatableElementCounter++;
        } else if (currentChildnode.nodeType === 1 && currentChildnode.childNodes	&& !/(script|style)/i.test(currentChildnode.tagName)){
          /* other nodes with childnodes */
          _initElements(currentChildnode);
        }
      }      
      return;
    }
	

	
    /* this function is called when annotateing starts */
    function onAnnotateStart(){
      textAnnotaterOn = true;
    }

    /* this function is called when annotateing ends */

    function onAnnotateEnd(){
      if (beingAnnotatedElementIdArray.length==0) return;

      var lastElement;

      if (textHiglighterOnAction==='add'){
        //fetch collection of elements currently being annotated
        var beingAnnotatedElements = $("."+options.beingAnnotatedClassName);

        if (beingAnnotatedElements.size()>0){
          addAnnotation(beingAnnotatedElements);
        }
      }

      textAnnotaterOn = false;
			
      lastElement = jQuery('#'+options.elementIdPrefix+beingAnnotatedElementIdArray[beingAnnotatedElementIdArray.length-1]);
      setElementAnnotationFocus(lastElement);
			
			
      beingAnnotatedElementIdArray = [];

    }

    function addHighlight(element, autoFill){
      var firstAnnotatedElementId, numberOfBeingAnnotatedElements;

      /* init */
      element  = $(element);
      autoFill = autoFill==undefined ? true : false;

      var highlighterElements, startIndex, endIndex, i

      /*
        should we also highlight the elements between the first highlighted
        element and this one?
       */
      if (autoFill==true && beingAnnotatedElementIdArray.length>0){
        highlighterElements = $('.'+options.elementClassName);

        firstAnnotatedElementId = beingAnnotatedElementIdArray[0];

        if (element.data('textAnnotate.annotaterId')>firstAnnotatedElementId){
          startIndex = firstAnnotatedElementId;
          endIndex   = element.data('textAnnotate.annotaterId');
        }else{
          startIndex = element.data('textAnnotate.annotaterId');
          endIndex   = firstAnnotatedElementId;
        }

        for (i=startIndex; i<endIndex; i++){
          addHighlight(highlighterElements.get(i), false);
        }

        numberOfBeingAnnotatedElements = beingAnnotatedElementIdArray.length;
        for (i=0; i<numberOfBeingAnnotatedElements; i++){
          if (beingAnnotatedElementIdArray[i]<startIndex || beingAnnotatedElementIdArray[i]>endIndex){
            removeHighlight($('#'+options.elementIdPrefix+beingAnnotatedElementIdArray[i]));
            i--;
          }
        }
      }
			
      if (element.data('textAnnotate.beingAnnotated')!=true){
        element.addClass(options.beingAnnotatedClassName );
        element.data('textAnnotate.beingAnnotated', true);
        beingAnnotatedElementIdArray.push(element.data('textAnnotate.annotaterId'));
				
      }
    }

    /**
     * Removes a highlight
     * @param element
     *   A DOM node
     **/
    function removeHighlight(element){
      var newAnnotateLevel;
      var currentAnnotateLevel = parseInt(element.attr('annotateLevel'));
		
      element = $(element);
      element.removeClass(options.beingAnnotatedClassName );
		
      if (currentAnnotateLevel>0){
        newAnnotateLevel = currentAnnotateLevel>0 ? currentAnnotateLevel-1 : 0;
        element.attr('annotateLevel', newAnnotateLevel);
      }else{
        element.removeAttr('annotateLevel');
      }
      element.data('textAnnotate.beingAnnotated', false);
	
      beingAnnotatedElementIdArray.splice($.inArray(element.data('textAnnotate.annotaterId'), beingAnnotatedElementIdArray),1);
    }

    /**
     * Remove an element's annotation
     * @param element
     *  DOM node
     * @param annotationIndexToRemoveFrom
     *  The annotation index
     **/
    function removeElementAnnotation(element, annotationIndexToRemoveFrom){
      element = $(element);

      var annotateLevel = parseInt(element.attr('annotateLevel'));
		
      /* remove element from annotation data */
      _removeElementFromAnnotationData(element, annotationIndexToRemoveFrom);

      /* remove annotation focus class */
      element.removeClass(options.annotationFocusClassName);

      /* set annotatelevel and css	*/
      annotateLevel = annotateLevel-1;
      if (annotateLevel<0){
        element.removeAttr('annotateLevel');
        element.removeClass(options.annotatedClassName);
      }else{
        element.attr('annotateLevel', annotateLevel);
      }

      /* remove data */
      element.removeData('textAnnotate.beingAnnotated');
      element.removeData('textAnnotate.formValues');
      element.removeData('textAnnotate.element');
    }

    /**
     * Get an annotation element ids
     * @param annotationId
     *  integer
     **/
    function _getAnnotationElementIds(annotationId){
      var annotationElementIds = [], key, i=0;
			
      for (key in global_annotations[annotationId]){
        annotationElementIds[i] = global_annotations[annotationId][key].elementId;
        i++;
      }
			
      return annotationElementIds;
    }

    /**
     * Removes an element from an annotation's data
     * @param element
     *  DOM node
     * @param annotationId
     *  The annotation id
     **/
    function _removeElementFromAnnotationData(element, annotationId){
      element = $(element);
      var annotationIndexInElement;
      var annotationElementIds = _getAnnotationElementIds(annotationId);
      var elementIdIndex    = $.inArray(element.attr('id'), annotationElementIds);

      /* remove element id from annotation */
      if (elementIdIndex!=-1){
        annotationElementIds.splice(elementIdIndex, 1);
      }

      /* remove annotation index from element */
      annotationIndexInElement = $.inArray(annotationId, element.data('textAnnotate.annotationIndexes'));
      if (annotationIndexInElement!=-1){
        element.data('textAnnotate.annotationIndexes').splice(annotationIndexInElement, 1);
      }
    }

    /**
     * Logger for debugging
     **/
    function _consolelog(msg){
      if (typeof console!='undefined'){
        //console.log(msg);
      } else{
        $('#consolelog').prepend(msg);
      }
    }

    /**
     * Removes all empty annotations
     **/
    function _removeEmptyAnnotations(){
      $(global_annotations).each(function(annotationId, annotation){
        if (annotation.length===0){
          delete global_annotations[annotationId];
        }
      });
    }

    /**
     * Removes all elements from an annotation
     * @param annotationId
     *  The annotation id
     **/
    function removeAllElementsFromAnnotation(annotationId){
      var elementIds = _getAnnotationElementIds(annotationId)
			
      $(elementIds).each(function(index, value){
        removeElementAnnotation('#'+value, annotationId);
      });
    }


    /**
     * Sets the focus to an annotation
     * @param elementInAnnotation
     *  DOM node, one of the elements in the annotation
     **/
    function setElementAnnotationFocus(elementInAnnotation){
      var annotationsElementIds, elementAnnotationIndexes;
      var element;

      /* user userDialog */
	
      //show the dialog and position it
      showUserDialog(elementInAnnotation)
      loadElementForm(elementInAnnotation);
		
      elementAnnotationIndexes           = elementInAnnotation.data('textAnnotate.annotationIndexes');
			
      indexesOfAnnotationsWithFocus = elementAnnotationIndexes;
			
      $(elementAnnotationIndexes).each(function(index, value){
        annotationsElementIds = _getAnnotationElementIds(value);
								
        $(annotationsElementIds).each(function(index, value){
          element = $('#'+value);
          $(element).addClass(options.annotationFocusClassName);
        });
      });
    }

    /**
     * Shows the user dialog for an element
     * @param element
     *  DOM node
     **/
    function showUserDialog (element){
      var dialogCSS = {
        "left": parseInt(element.offset().left, 10),
        "top": parseInt(element.offset().top,10)+parseInt(element.height(), 10)
      };

      var listenerData = {
        "element": element,
        "dialogCSS": dialogCSS
      };

      if (notifyListeners('beforeshowdialog', listenerData)==false){
        return;
      }     
      
      //show the dialog and position it
      userDialog.show();
      userDialog.css(dialogCSS);

      //store reference to element
      userDialog.data('textAnnotate.element', element);
    }

    /**
     * Hides the user dialog
     **/
    function hideUserDialog (){
      if (notifyListeners('beforehidedialog')==false){
        return;
      }
      userDialog.hide();
    }

    /**
     * Removes the focus from the currently annotation having focus
     **/
    function removeAnnotationFocus(){
      var annotationsElementIds;
      if (textAnnotaterOn===true || indexesOfAnnotationsWithFocus===undefined){
        return;
      }

      /* hide the user dialog */
      hideUserDialog();

      /* remove classes from elements */
      $(indexesOfAnnotationsWithFocus).each(function(){
        annotationsElementIds = _getAnnotationElementIds(this);
        $(annotationsElementIds).each(function(index, value){
          var element = $('#'+value);
          $(element).removeClass(options.annotationFocusClassName);
        });
      });
		
      indexesOfAnnotationsWithFocus = undefined;
    }

    /**
     * Removes the annotation having focus
     **/
    function removeAnnotationWithFocus(){
      var i, j;
      /* remove annotation focus and dialog */
      $('.'+options.annotationFocusClassName).removeClass(options.annotationFocusClassName);
      userDialog.hide();
			
      /* remove annotations */
      $(indexesOfAnnotationsWithFocus).each(function(index, value){
        removeAnnotation(value);
      });
    }

    /**
     * Removes an annotation
     * @param annotationId
     *  Integer
     **/
    function removeAnnotation(annotationId){

      var annotationToRemove = $.extend(true,{}, global_annotations[annotationId]);

      removeAllElementsFromAnnotation(annotationId);
			
      delete global_annotations[annotationId];
						
      //call listener
      notifyListeners('removeAnnotation', annotationToRemove);
    }

    /**
     * Saves the form of the annotation having focus
     **/
    function saveAnnotationFormWithFocus(){
      var annotationElementIds, annotationId, index;
      var serializedForm = formElement.serializeArray();

      /* loop over all annotations having a focus */
      $(indexesOfAnnotationsWithFocus).each(function(index, annotationId){
        /* get all elements within annotation */
        annotationElementIds = _getAnnotationElementIds(annotationId);
        $(annotationElementIds).each(function(index, elementId){
          saveElementForm(annotationId, $('#'+elementId), serializedForm)
        });

        //call listener
        notifyListeners('saveForm',{
          "annotation": global_annotations[this],
          "formValues": serializedForm
        });
      });
    }

    /**
     * Saves the form of an element
     * @param annotationId
     *  integer: the annotation Id
     * @param element
     *  DOM node
     * @param serializedForm
     *  String
     **/
    function saveElementForm(annotationId, element, serializedForm){
      var annotationElements, numberOfElements, i;
      element.data('textAnnotate.formValues', serializedForm);

      annotationElements = global_annotations[annotationId];

      numberOfElements = annotationElements.length;
      for (i=0; i<numberOfElements; i++){
        if (annotationElements[i].elementId==element.attr('id')){
          annotationElements[i].formValues = serializedForm;
        }
      }
    }

    /**
     * Loads the form of an element
     * @param element
     *  DOM node
     **/
    function loadElementForm(element){
      var key, data ={};
      var formValues = $(element).data('textAnnotate.formValues');

      /* reset the form */
      formElement.each(function(){
        this.reset();
      });

      /* set new values */
      if (formValues){
        $(formValues).each(function(index, value){
          key   = this.name;
          value = this.value;


          if (data[key]==undefined){
            data[key] = [value];
          }else{
            $.merge(data[key], [value]);
          }
        });

        for (key in data){
          formElement.find('[name='+key+']').val(data[key]);
        }
      }
    }

    /**
     * Notify all listeners of type "type" that an event occurred, with the
     * given data.
     *
     * @param type
     *   The type of event.
     * @param data
     *   The data of the event.
     * @return boolean (false if one of the listening functions returns false)
     */
    function notifyListeners(type, data){
      var listeners = main_element.data("textAnnotate.listeners");

      var i, value, returnValue;
      type = type.toLowerCase();
      if (listeners && listeners[type]){
        _consolelog(listeners[type]);
        for (i = 0; i < listeners[type].length; i++){
          value = listeners[type][i].call(null, data);
          returnValue = returnValue == false ? false : value;
        }
      }

      return returnValue;
    }

    /**
     * Removes whitespaces from the beginning and ending of a string
     * @param value
     * @return string
     **/
    function _trim(value){
      value = value.replace(/^\s+/,'');
      value = value.replace(/\s+$/,'');
      return value;
    }

    /**
     * Disables text selection for an element
     * @param element
     *  DOM node
     **/
    function _disableTextSelect(element){
      return jQuery(element).each(function(){
        $(this).css({
          '-moz-user-select' : 'none'
        }).bind('selectstart', function(){
          return false;
        });
      });
    };

    /**
     * Enables text selection for an element
     * @param element
     *  DOM node
     **/
    function _enableTextSelect(element){
      return jQuery(element).each(function(){
        $(this).css({
          '-moz-user-select':'text'
        }).unbind('selectstart');
      });
    };
  }
})(jQuery);
