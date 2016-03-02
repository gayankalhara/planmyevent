/*
formBuilder - http://kevinchappell.github.io/formBuilder/
Version: 1.7.8
Author: Kevin Chappell <kevin.b.chappell@gmail.com>
*/
'use strict';

(function ($) {
  'use strict';

  var Toggle = function Toggle(element, options) {

    var defaults = {
      theme: 'fresh',
      labels: {
        off: 'Off',
        on: 'On'
      }
    };

    var opts = $.extend(defaults, options),
        $kcToggle = $('<div class="kc-toggle"/>').insertAfter(element).append(element);

    $kcToggle.toggleClass('on', element.is(':checked'));

    var kctOn = '<div class="kct-on">' + opts.labels.on + '</div>',
        kctOff = '<div class="kct-off">' + opts.labels.off + '</div>',
        kctHandle = '<div class="kct-handle"></div>',
        kctInner = '<div class="kct-inner">' + kctOn + kctHandle + kctOff + '</div>';

    $kcToggle.append(kctInner);

    $kcToggle.click(function () {
      element.attr('checked', !element.attr('checked'));
      $(this).toggleClass('on');
    });
  };

  $.fn.kcToggle = function (options) {
    var toggle = this;
    return toggle.each(function () {
      var element = $(this);
      if (element.data('kcToggle')) {
        return;
      }
      var kcToggle = new Toggle(element, options);
      element.data('kcToggle', kcToggle);
    });
  };
})(jQuery);
'use strict';

(function ($) {
  'use strict';
  var FormBuilder = function FormBuilder(element, options) {

    var defaults = {
      // Uneditable fields or other content you would like to
      // appear before and after regular fields.
      disableFields: {
        // before: '<h2>Header</h2>',
        // after: '<h3>Footer</h3>'
      },
      // array of objects with fields values
      // ex:
      // defaultFields: [{
      //   label: 'First Name',
      //   name: 'first-name',
      //   required: 'true',
      //   description: 'Your first name',
      //   type: 'text'
      // }, {
      //   label: 'Phone',
      //   name: 'phone',
      //   description: 'How can we reach you?',
      //   type: 'text'
      // }],
      defaultFields: [],
      roles: {
        1: 'Administrator'
      },
      showWarning: false,
      serializePrefix: 'frmb',
      messages: {
        add: 'Add Item',
        allowSelect: 'Allow Select',
        cannotBeEmpty: 'This field cannot be empty',
        checkboxGroup: 'Checkbox Group',
        checkbox: 'Checkbox',
        checkboxes: 'Checkboxes',
        clearAllMessage: 'Are you sure you want to remove all items?',
        clearAll: 'Clear All',
        close: 'Close',
        copy: 'Copy To Clipboard',
        dateField: 'Date Field',
        description: 'Help Text',
        descriptionField: 'Description',
        devMode: 'Developer Mode',
        disableFields: 'These fields cannot be moved.',
        editNames: 'Edit Names',
        editorTitle: 'Form Elements',
        editXML: 'Edit XML',
        fieldVars: 'Field Variables',
        fieldRemoveWarning: 'Are you sure you want to remove this field?',
        getStarted: 'Drag a field from the right to this area',
        hide: 'Edit',
        hidden: 'Hidden Input',
        label: 'Label',
        labelEmpty: 'Field Label cannot be empty',
        limitRole: 'Limit access to one or more of the following roles:',
        mandatory: 'Mandatory',
        maxlength: 'Max Length',
        minOptionMessage: 'This field requires a minimum of 2 options',
        name: 'Name',
        no: 'No',
        off: 'Off',
        on: 'On',
        optional: 'optional',
        optionLabelPlaceholder: 'Label',
        optionValuePlaceholder: 'Value',
        optionEmpty: 'Option value required',
        paragraph: 'Paragraph',
        placeholder: 'Placeholder',
        placeholders: {
          text: '',
          textarea: '',
          email: 'Enter you email',
          password: 'Enter your password'
        },
        preview: 'Preview',
        radioGroup: 'Radio Group',
        radio: 'Radio',
        removeMessage: 'Remove Element',
        remove: '&#215;',
        required: 'Required',
        richText: 'Rich Text Editor',
        roles: 'Access',
        save: 'Save Template',
        selectOptions: 'Select Items',
        select: 'Select',
        selectColor: 'Select Color',
        selectionsMessage: 'Allow Multiple Selections',
        subtype: 'HTML5 type',
        subtypes: {
          text: ['text', 'password', 'email', 'color']
        },
        text: 'Text Field',
        textArea: 'Text Area',
        toggle: 'Toggle',
        warning: 'Warning!',
        viewXML: 'View XML',
        yes: 'Yes'
      }
    };

    // @todo function to set parent types for subtypes
    defaults.messages.subtypes.password = defaults.messages.subtypes.text;
    defaults.messages.subtypes.email = defaults.messages.subtypes.text;
    defaults.messages.subtypes.color = defaults.messages.subtypes.text;

    var startIndex,
        doCancel = false,
        _helpers = {};

    /**
     * Convert an attrs object into a string
     * @param  {object} attrs object of attributes for markup
     * @return {string}
     */
    _helpers.attrString = function (attrs) {
      var attributes = [];

      for (var attr in attrs) {
        if (attrs.hasOwnProperty(attr)) {
          attr = _helpers.safeAttr(attr, attrs[attr]);
          attributes.push(attr.name + attr.value);
        }
      }
      return attributes.join(' ');
    };

    /**
     * Convert camelCase into lowercase-hyphen
     * @param  {string} str
     * @return {string}
     */
    _helpers.hyphenCase = function (str) {
      return str.replace(/([A-Z])/g, function ($1) {
        return '-' + $1.toLowerCase();
      });
    };

    _helpers.safeAttr = function (name, value) {
      var safeAttr = {
        className: 'class'
      };

      name = safeAttr[name] || _helpers.hyphenCase(name);
      value = window.JSON.stringify(value);
      value = value ? '=' + value : '';

      return {
        name: name,
        value: value
      };
    };

    /**
     * Add a mobile class
     * @return {string}
     */
    _helpers.mobileClass = function () {
      var mobileClass = '';
      (function (a) {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) {
          mobileClass = ' fb-mobile';
        }
      })(navigator.userAgent || navigator.vendor || window.opera);
      return mobileClass;
    };

    /**
     * Callback for when a drag begins
     * @param  {object} event
     * @param  {object} ui
     */
    _helpers.startMoving = function (event, ui) {
      event = event;
      ui.item.addClass('moving');
      startIndex = $('li', this).index(ui.item);
    };

    /**
     * Callback for when a drag ends
     * @param  {object} event
     * @param  {object} ui
     */
    _helpers.stopMoving = function (event, ui) {
      event = event;
      ui.item.removeClass('moving');
      if (doCancel) {
        $(ui.sender).sortable('cancel');
        $(this).sortable('cancel');
      } else {
        _helpers.save();
      }
    };

    /**
     * Make strings safe to be used as classes
     * @param  {string} str string to be converted
     * @return {string}     converter string
     */
    _helpers.safename = function (str) {
      return str.replace(/\s/g, '-').replace(/[^a-zA-Z0-9\-]/g, '').toLowerCase();
    };

    /**
     * Strips non-numbers from a number only input
     * @param  {string} str string with possible number
     * @return {string}     string without numbers
     */
    _helpers.forceNumber = function (str) {
      return str.replace(/[^0-9]/g, '');
    };

    /**
     * hide and show mouse tracking tooltips, only used for disabled
     * fields in the editor.
     * @todo   remove or refactor to make better use
     * @param  {object} tt jQuery option with nexted tooltip
     * @return {void}
     */
    _helpers.initTooltip = function (tt) {
      var tooltip = tt.find('.tooltip');
      tt.mouseenter(function () {
        if (tooltip.outerWidth() > 200) {
          tooltip.addClass('max-width');
        }
        tooltip.css('left', tt.width() + 14);
        tooltip.stop(true, true).fadeIn('fast');
      }).mouseleave(function () {
        tt.find('.tooltip').stop(true, true).fadeOut('fast');
      });
      tooltip.hide();
    };

    // saves the field data to our canvas (elem)
    _helpers.save = function () {
      $sortableFields.children('li').not('.disabled').each(function () {
        _helpers.updatePreview($(this));
      });
      elem.val($sortableFields.toXML());
      elem.trigger('change');
    };

    // updatePreview will generate the preview for radio and checkbox groups
    _helpers.updatePreview = function (field) {
      var fieldClass = field.attr('class'),
          fieldType,
          $prevHolder = $('.prev-holder', field);

      if (fieldClass.indexOf('ui-sortable-handle') !== -1) {
        return;
      }

      var subtype = $('.fld-subtype', field).val();
      fieldClass = fieldClass.replace(' form-field', '');

      if (subtype) {
        fieldType = subtype;
      } else {
        fieldType = fieldClass;
      }

      var preview,
          previewData = {
        type: fieldType,
        label: $('.fld-label', field).val()
      };

      var maxlength = $('.fld-maxlength', field);
      if (maxlength) {
        previewData.maxlength = maxlength.val();
      }

      var placeholder = $('.fld-placeholder', field).val();
      if (placeholder) {
        previewData.placeholder = placeholder;
      }

      if (fieldClass === 'checkbox') {
        previewData.toggle = $('.checkbox-toggle', field).is(':checked');
      }

      if (fieldClass.match(/(select|checkbox-group|radio-group)/)) {
        previewData.values = [];
        previewData.multiple = $('[name="multiple"]', field).is(':checked');

        $('.sortable-options li', field).each(function () {
          var option = {};
          option.selected = $('.select-option', $(this)).is(':checked');
          option.value = $('.option-value', $(this)).val();
          option.label = $('.option-label', $(this)).val();

          previewData.values.push(option);
        });
      }

      preview = fieldPreview(previewData);

      $prevHolder.html(preview);

      $('input[toggle]', $prevHolder).kcToggle();
    };

    // update preview to label
    _helpers.updateMultipleSelect = function () {
      $sortableFields.delegate('input[name="multiple"]', 'change', function () {
        var options = $(this).parents('.fields:eq(0)').find('.sortable-options input.select-option');
        if (this.checked) {
          options.each(function () {
            $(this).prop('type', 'checkbox');
          });
        } else {
          options.each(function () {
            $(this).removeAttr('checked').prop('type', 'radio');
          });
        }
      });
    };

    _helpers.htmlEncode = function (value) {
      return $('<div/>').text(value).html();
    };

    _helpers.htmlDecode = function (value) {
      return $('<div/>').html(value).text();
    };

    _helpers.validateForm = function () {
      var errors = [];
      // check for empty field labels
      $('input[name="label"], input[type="text"].option', $sortableFields).each(function () {
        if ($(this).val() === '') {
          var field = $(this).parents('li.form-field'),
              fieldAttr = $(this);
          errors.push({
            field: field,
            error: opts.messages.labelEmpty,
            attribute: fieldAttr
          });
        }
      });

      // @todo add error = { noVal: opts.messages.labelEmpty }
      if (errors.length) {
        alert('Error: ' + errors[0].error);
        $('html, body').animate({
          scrollTop: errors[0].field.offset().top
        }, 1000, function () {
          var targetID = $('.toggle-form', errors[0].field).attr('id');
          $('.toggle-form', errors[0].field).addClass('open').parent().next('.prev-holder').slideUp(250);
          $('#' + targetID + '-fld').slideDown(250, function () {
            errors[0].attribute.addClass('error');
          });
        });
      }
    };

    _helpers.disabledTT = function (field) {
      var title = field.attr('data-tooltip');
      if (title) {
        field.removeAttr('title').data('tip_text', title);
        var tt = $('<p/>', {
          'class': 'frmb-tt'
        }).html(title);
        field.append(tt);
        tt.css({
          top: -tt.outerHeight(),
          left: -15
        });
        field.mouseleave(function () {
          $(this).attr('data-tooltip', field.data('tip_text'));
          $('.frmb-tt').remove();
        });
      }
    };

    var opts = $.extend(true, defaults, options),
        elem = $(element),
        frmbID = 'frmb-' + $('ul[id^=frmb-]').length++;

    var field = '',
        lastID = 1,
        boxID = frmbID + '-control-box';

    // create array of field objects to cycle through
    var frmbFields = [{
      label: opts.messages.text,
      attrs: {
        type: 'text',
        className: 'text-input',
        name: 'text-input'
      }
    }, {
      label: opts.messages.select,
      attrs: {
        type: 'select',
        className: 'select',
        name: 'select'
      }
    }, {
      label: opts.messages.textArea,
      attrs: {
        type: 'textarea',
        className: 'rich-text',
        name: 'rich-text'
      }
    }, {
      label: opts.messages.radioGroup,
      attrs: {
        type: 'radio-group',
        className: 'radio-group',
        name: 'radio-group'
      }
    }, {
      label: opts.messages.hidden,
      attrs: {
        type: 'hidden',
        className: 'hidden-input',
        name: 'hidden-input'
      }
    }, {
      label: opts.messages.dateField,
      attrs: {
        type: 'date',
        className: 'calendar',
        name: 'date-input'
      }
    }, {
      label: opts.messages.checkboxGroup,
      attrs: {
        type: 'checkbox-group',
        className: 'checkbox-group',
        name: 'checkbox-group'
      }
    }, {
      label: opts.messages.checkbox,
      attrs: {
        type: 'checkbox',
        className: 'checkbox',
        name: 'checkbox'
      }
    }];

    // Create draggable fields for formBuilder
    var cbUL = $('<ul/>', {
      id: boxID,
      'class': 'frmb-control'
    });

    // Loop through
    for (var i = frmbFields.length - 1; i >= 0; i--) {
      var $field = $('<li/>', {
        'class': 'icon-' + frmbFields[i].attrs.className,
        'type': frmbFields[i].type,
        'name': frmbFields[i].className,
        'label': frmbFields[i].label
      });
      for (var attr in frmbFields[i]) {
        if (frmbFields[i].hasOwnProperty(attr)) {
          $field.data(attr, frmbFields[i][attr]);
        }
      }
      $field.html(frmbFields[i].label).appendTo(cbUL);
    }

    // Build our headers and action links
    var cbHeader = $('<h4/>').html(opts.messages.editorTitle),
        viewXML = $('<a/>', {
      id: frmbID + '-export-xml',
      text: "opts.messages.viewXML",
      href: '#',
      'class': 'view-xml'
    }),
        allowSelect = $('<a/>', {
      id: frmbID + '-allow-select',
      text: opts.messages.allowSelect,
      href: '#',
      'class': 'allow-select'
    }).prop('checked', 'checked'),
        editXML = $('<a/>', {
      id: frmbID + '-edit-xml',
      text: opts.messages.editXML,
      href: '#',
      'class': 'edit-xml'
    }),
        editNames = $('<a/>', {
      id: frmbID + '-edit-names',
      text: opts.messages.editNames,
      href: '#',
      'class': 'edit-names'
    }),
        clearAll = $('<a/>', {
      id: frmbID + '-clear-all',
      text: opts.messages.clearAll,
      href: '#',
      'class': 'clear-all'
    }),
        saveAll = $('<div/>', {
      id: frmbID + '-save',
      href: '#',
      'class': 'save-btn-wrap',
      title: opts.messages.save
    });

    // Sortable fields
    var $sortableFields = $('<ul/>').attr('id', frmbID).addClass('frmb').sortable({
      cursor: 'move',
      opacity: 0.9,
      beforeStop: function beforeStop(event, ui) {
        event = event;
        var lastIndex = $('> li', $sortableFields).length - 1,
            curIndex = ui.placeholder.index();
        if (opts.disableFields.before) {
          doCancel = curIndex <= 1;
        } else if (opts.disableFields.after) {
          doCancel = curIndex === lastIndex;
        } else {
          doCancel = false;
        }
      },
      start: _helpers.startMoving,
      stop: _helpers.stopMoving,
      cancel: 'input, select, .disabled, .frm-fld, .btn',
      placeholder: 'frmb-placeholder'
    });

    // ControlBox with different fields
    cbUL.sortable({
      helper: 'clone',
      opacity: 0.9,
      connectWith: $sortableFields,
      cursor: 'move',
      placeholder: 'ui-state-highlight',
      start: _helpers.startMoving,
      stop: _helpers.stopMoving,
      revert: 150,
      remove: function remove(event, ui) {
        event = event;
        if (startIndex === 0) {
          cbUL.prepend(ui.item);
        } else {
          $('li:nth-child(' + startIndex + ')', cbUL).after(ui.item);
        }
      },
      beforeStop: function beforeStop(event, ui) {
        event = event;
        if (ui.placeholder.parent().hasClass('frmb-control')) {
          doCancel = true;
        }
      },
      update: function update(event, ui) {
        event = event;
        elem.stopIndex = $('li', $sortableFields).index(ui.item) === 0 ? '0' : $('li', $sortableFields).index(ui.item);
        if ($('li', $sortableFields).index(ui.item) < 0) {
          $(this).sortable('cancel');
        } else {
          prepFieldVars($(ui.item[0]), true);
        }
      },
      receive: function receive(event, ui) {
        event = event;
        if (ui.sender.hasClass('frmb') || ui.sender.hasClass('frmb-control')) {
          $(ui.sender).sortable('cancel');
        }
      }
    });

    var $stageWrap = $('<div/>', {
      id: frmbID + '-stage-wrap',
      'class': 'stage-wrap'
    });

    var $formWrap = $('<div/>', {
      id: frmbID + '-form-wrap',
      'class': 'form-wrap form-builder' + _helpers.mobileClass()
    });

    elem.before($stageWrap).appendTo($stageWrap);

    var cbWrap = $('<div/>', {
      id: frmbID + '-cb-wrap',
      'class': 'cb-wrap'
    }).append(cbHeader, cbUL);

    $stageWrap.append($sortableFields, cbWrap);
    $stageWrap.before($formWrap);
    $formWrap.append($stageWrap, cbWrap);

    var doSave = function doSave() {
      if ($(this).parents('li.disabled').length === 0) {
        if ($(this).name === 'label' && $(this).val() === '') {
          return alert('Error: ' + opts.messages.labelEmpty);
        }
        _helpers.save();
      }
    };

    // Not pretty but we need to save a lot so users don't have to keep clicking a save button
    $('input, select', $sortableFields).on('change', doSave);
    $('input, select', $sortableFields).on('blur', doSave);

    // Parse saved XML template data
    elem.getTemplate = function () {
      var xml = elem.val() !== '' ? $.parseXML(elem.val()) : false,
          fields = $(xml).find('field');

      if (fields.length > 0) {
        fields.each(function () {
          prepFieldVars($(this));
        });
      } else if (!xml) {
        // Load default fields if none are set
        if (opts.defaultFields.length) {
          opts.defaultFields.reverse();
          for (var i = opts.defaultFields.length - 1; i >= 0; i--) {
            appendNewField(opts.defaultFields[i]);
          }
        } else {
          $stageWrap.addClass('empty').attr('data-content', opts.messages.getStarted);
        }
        disabledBeforeAfter();
      }
    };

    var disabledBeforeAfter = function disabledBeforeAfter() {
      var li = '<li class="disabled __POSITION__">__CONTENT__</li>';
      if (opts.disableFields.before && !$('.disabled.before', $sortableFields).length) {
        $sortableFields.prepend(li.replace('__POSITION__', 'before').replace('__CONTENT__', opts.disableFields.before));
      }
      if (opts.disableFields.after && !$('.disabled.after', $sortableFields).length) {
        $sortableFields.append(li.replace('__POSITION__', 'after').replace('__CONTENT__', opts.disableFields.after));
      }
    };

    var nameAttr = function nameAttr(field) {
      var epoch = new Date().getTime();
      return field.data('attrs').name + '-' + epoch;
    };

    var prepFieldVars = function prepFieldVars($field, isNew) {
      isNew = isNew || false;

      var fieldAttrs = $field.data('attrs') || {},
          fType = fieldAttrs.type || $field.attr('type'),
          isMultiple = fType.match(/(select|checkbox-group|radio-group)/),
          values = {};

      values.label = _helpers.htmlEncode($field.attr('label'));
      values.name = isNew ? nameAttr($field) : fieldAttrs.name || $field.attr('name');
      values.role = $field.attr('role');
      values.required = $field.attr('required');
      values.maxlength = $field.attr('maxlength');
      values.toggle = $field.attr('toggle');
      values.multiple = $field.attr('multiple');
      values.type = fType;
      values.description = $field.attr('description') !== undefined ? _helpers.htmlEncode($field.attr('description')) : '';

      if (isMultiple) {
        if (values.type === 'checkbox-group') {
          values.multiple = true;
        }

        values.values = [];
        $field.children().each(function () {
          var value = {
            label: $(this).text(),
            value: $(this).attr('value'),
            selected: Boolean($(this).attr('selected'))
          };
          values.values.push(value);
        });
      }

      appendNewField(values);
      $stageWrap.removeClass('empty');
      disabledBeforeAfter();
    };

    // multi-line textarea
    var appendTextarea = function appendTextarea(values) {
      appendFieldLi(opts.messages.textArea, advFields(values), values);
    };

    var appendInput = function appendInput(values) {
      var type = values.type || 'text';
      appendFieldLi(opts.messages[type], advFields(values), values);
    };

    // add select dropdown
    var appendSelectList = function appendSelectList(values) {

      if (!values.values || !values.values.length) {
        values.values = [{
          selected: true,
          label: 'Option 1',
          value: 'option-1'
        }, {
          selected: false,
          label: 'Option 2',
          value: 'option-2'
        }];
      }

      var field = '',
          name = _helpers.safename(values.name);

      field += advFields(values);
      field += '<div class="false-label">' + opts.messages.selectOptions + '</div>';
      field += '<div class="fields">';

      if (values.type === 'select') {
        field += '<div class="allow-multi">';
        field += '<input type="checkbox" id="multiple_' + lastID + '" name="multiple"' + (values.multiple ? 'checked="checked"' : '') + '>';
        field += '<label class="multiple" for="multiple_' + lastID + '">' + opts.messages.selectionsMessage + '</label>';
        field += '</div>';
      }
      field += '<ol class="sortable-options">';
      for (i = 0; i < values.values.length; i++) {
        field += selectFieldOptions(values.values[i], name, values.values[i].selected, values.multiple);
      }
      field += '</ol>';
      field += '<div class="field_actions"><a href="javascript: void(0);" class="add add_opt"><strong>' + opts.messages.add + '</strong></a> | <a href="javascript: void(0);" class="close-field">' + opts.messages.close + '</a></div>';
      field += '</div>';
      appendFieldLi(opts.messages.select, field, values);

      $('.sortable-options').sortable(); // making the dynamically added option fields sortable.
    };

    var appendNewField = function appendNewField(values) {

      if (values === undefined) {
        values = '';
      }

      // TODO: refactor to move functions into this object
      var appendFieldType = {
        '2': appendInput,
        'date': appendInput,
        'checkbox': appendInput,
        'select': appendSelectList,
        'rich-text': appendTextarea,
        'textarea': appendTextarea,
        'radio-group': appendSelectList,
        'checkbox-group': appendSelectList,
        'text': appendInput,
        'password': appendInput,
        'email': appendInput,
        'color': appendInput,
        'hidden': appendInput
      };

      if (typeof appendFieldType[values.type] === 'function') {
        appendFieldType[values.type](values);
      }
    };

    /**
     * Build the editable properties for the field
     * @param  {object} values configuration object for advanced fields
     * @return {string}        markup for advanced fields
     */
    var advFields = function advFields(values) {

      var advFields = '',
          key,
          roles = values.role !== undefined ? values.role.split(',') : [];
      var fieldLabel = $('<div>', {
        'class': 'frm-fld label-wrap'
      });
      $('<label/>').text(opts.messages.label).appendTo(fieldLabel);
      $('<input>', {
        type: 'text',
        name: 'label',
        value: values.label,
        'class': 'fld-label form-control'
      }).appendTo(fieldLabel);
      advFields += fieldLabel[0].outerHTML;

      var fieldDesc = $('<div>', {
        'class': 'frm-fld description-wrap'
      });
      $('<label/>').text(opts.messages.description).appendTo(fieldDesc);

      advFields += '<div class="frm-fld description-wrap"><label>' + opts.messages.description + '</label>';
      advFields += '<input type="text" name="description" value="' + values.description + '" class="fld-description form-control" id="description-' + lastID + '" /></div>';

      advFields += getSubTypeField(values.type);

      advFields += getPlaceholder(values.type);

      advFields += '<div class="frm-fld name-wrap"><label>' + opts.messages.name + ' <span class="required">*</span></label>';
      advFields += '<input type="text" name="name" value="' + values.name + '" class="fld-name form-control" id="title-' + lastID + '" /></div>';

      advFields += '<div class="frm-fld access-wrap"><label>' + opts.messages.roles + '</label>';

      advFields += '<input type="checkbox" name="enable_roles" value="" ' + (values.role !== undefined ? 'checked' : '') + ' id="enable_roles-' + lastID + '"/> <label for="enable_roles-' + lastID + '" class="roles-label">' + opts.messages.limitRole + '</label>';
      advFields += '<div class="frm-fld available-roles" ' + (values.role !== undefined ? 'style="display:block"' : '') + '>';

      for (key in opts.roles) {
        if ($.inArray(key, ['date', '4']) === -1) {
          advFields += '<input type="checkbox" name="roles[]" value="' + key + '" id="fld-' + lastID + '-roles-' + key + '" ' + ($.inArray(key, roles) !== -1 ? 'checked' : '') + ' class="roles-field" /><label for="fld-' + lastID + '-roles-' + key + '">' + opts.roles[key] + '</label><br/>';
        }
      }
      advFields += '</div></div>';

      // if field type is not checkbox, checkbox/radio group or select list, add max length
      if ($.inArray(values.type, ['checkbox', 'select', 'checkbox-group', 'date', 'radio-group', 'hidden']) < 0) {
        advFields += '<div class="frm-fld"><label class="maxlength-label">' + opts.messages.maxlength + '</label>';
        advFields += '<input type="text" name="maxlength" maxlength="4" value="' + (values.maxlength !== undefined ? values.maxlength : '') + '" class="fld-maxlength form-control" id="maxlength-' + lastID + '" /></div>';
      }

      return advFields;
    };

    var getSubTypeField = function getSubTypeField(type) {
      var subTypes = opts.messages.subtypes,
          subType = '';

      if (subTypes[type]) {
        var subTypeLabel = '<label>' + opts.messages.subtype + '</label>';
        subType += '<select name="subtype" class="fld-subtype form-control" id="subtype-' + lastID + '">';
        subTypes[type].forEach(function (element) {
          var selected = type === element ? 'selected' : '';
          subType += '<option value="' + element + '" ' + selected + '>' + element + '</option>';
        });
        subType += '</select>';
        subType = '<div class="frm-fld subtype-wrap">' + subTypeLabel + ' ' + subType + '</div>';
      }

      return subType;
    };

    var getPlaceholder = function getPlaceholder(type) {
      var placeholders = opts.messages.placeholders,
          placeholder = '';

      if (typeof placeholders[type] !== 'undefined') {
        var placeholderLabel = '<label>' + opts.messages.placeholder + '</label>';
        placeholder += '<input type="text" name="placeholder" placeholder="' + placeholders[type] + '" class="fld-placeholder form-control" id="placeholder-' + lastID + '">';
        placeholder = '<div class="frm-fld placeholder-wrap">' + placeholderLabel + ' ' + placeholder + '</div>';
      }

      return placeholder;
    };

    // Append the new field to the editor
    var appendFieldLi = function appendFieldLi(title, field, values) {
      var label = $(field).find('input[name="label"]').val() !== '' ? $(field).find('input[name="label"]').val() : title;

      var li = '',
          delBtn = '<a id="del_' + lastID + '" class="del-button btn delete-confirm" href="javascript: void(0);" title="' + opts.messages.removeMessage + '">' + opts.messages.remove + '</a>',
          toggleBtn = '<a id="frm-' + lastID + '" class="toggle-form btn icon-pencil" href="javascript: void(0);" title="' + opts.messages.hide + '"></a> ',
          required = values.required,
          toggle = values.toggle || undefined,
          tooltip = values.description !== '' ? '<span class="tooltip-element" tooltip="' + values.description + '">?</span>' : '';

      li += '<li id="frm-' + lastID + '-item" class="' + values.type + ' form-field">';
      li += '<div class="legend">';
      li += delBtn;
      li += '<span id="txt-title-' + lastID + '" class="field-label">' + label + '</span>' + tooltip + '<span class="required-asterisk" ' + (required === 'true' ? 'style="display:inline"' : '') + '> *</span>' + toggleBtn;
      li += '</div>';
      li += '<div class="prev-holder">' + fieldPreview(values) + '</div>';
      li += '<div id="frm-' + lastID + '-fld" class="frm-holder">';
      li += '<div class="form-elements">';
      li += '<div class="frm-fld">';
      li += '<label>&nbsp;</label>';
      li += '<input class="required" type="checkbox" value="1" name="required-' + lastID + '" id="required-' + lastID + '"' + (required === 'true' ? ' checked="checked"' : '') + ' /><label class="required-label" for="required-' + lastID + '">' + opts.messages.required + '</label>';
      if (values.type === 'checkbox') {
        li += '<div class="frm-fld">';
        li += '<label>&nbsp;</label>';
        li += '<input class="checkbox-toggle" type="checkbox" value="1" name="toggle-' + lastID + '" id="toggle-' + lastID + '"' + (toggle === 'true' ? ' checked="checked"' : '') + ' /><label class="toggle-label" for="toggle-' + lastID + '">' + opts.messages.toggle + '</label>';
        li += '</div>';
      }
      li += '</div>';
      li += field;
      li += '</div>';
      li += '</div>';
      li += '</li>';

      if (elem.stopIndex) {
        $('li', $sortableFields).eq(elem.stopIndex).after(li);
      } else {
        $sortableFields.append(li);
      }

      $(document.getElementById('frm-' + lastID + '-item')).hide().slideDown(250);

      lastID++;
      _helpers.save();
    };

    /**
     * Generate preview markup
     * @param  {object} attrs
     * @return {string}       preview markup for field
     */
    var fieldPreview = function fieldPreview(attrs) {
      var i,
          preview = '',
          epoch = new Date().getTime();
      var toggle = attrs.toggle ? 'toggle' : '';

      attrs.className = attrs.className ? attrs.className + ' form-control' : 'form-control';
      var attrsString = _helpers.attrString(attrs);

      switch (attrs.type) {
        case 'textarea':
        case 'rich-text':
          preview = '<textarea ' + attrsString + '></textarea>';
          break;
        case 'select':
          var options = undefined,
              multiple = attrs.multiple ? 'multiple' : '';
          attrs.values.reverse();
          for (i = attrs.values.length - 1; i >= 0; i--) {
            var selected = attrs.values[i].selected ? 'selected' : '';
            options += '<option value="' + attrs.values[i].value + '" ' + selected + '>' + attrs.values[i].label + '</option>';
          }
          preview = '<' + attrs.type + ' class="form-control" ' + multiple + '>' + options + '</' + attrs.type + '>';
          break;
        case 'checkbox-group':
        case 'radio-group':
          var type = attrs.type.replace('-group', '');
          attrs.values.reverse();
          for (i = attrs.values.length - 1; i >= 0; i--) {
            var checked = attrs.values[i].selected ? 'checked' : '';
            preview += '<div><input type="' + type + '" id="' + type + '-' + epoch + '-' + i + '" value="' + attrs.values[i].value + '" ' + checked + '/><label for="' + type + '-' + epoch + '-' + i + '">' + attrs.values[i].label + '</label></div>';
          }
          break;
        case 'text':
        case 'password':
        case 'email':
        case 'date':
          preview = '<input ' + attrsString + '>';
          break;
        case 'color':
          preview = '<input type="' + attrs.type + '" class="form-control"> ' + opts.messages.selectColor;
          break;
        case 'hidden':
        case 'checkbox':
          preview = '<input type="' + attrs.type + '" ' + toggle + ' >';
          break;
        default:
          preview = '<' + attrs.type + '></' + attrs.type + '>';
      }

      return preview;
    };

    // Select field html, since there may be multiple
    var selectFieldOptions = function selectFieldOptions(values, name, selected, multipleSelect) {
      var selectedType = multipleSelect ? 'checkbox' : 'radio';
      if (typeof values !== 'object') {
        values = {
          label: '',
          value: '',
          selected: false
        };
      } else {
        values.label = values.label || '';
        values.value = values.value || '';
        values.selected = values.selected || false;
      }

      selected = values.selected ? 'checked' : '';

      field = '<li>';
      field += '<input type="' + selectedType + '" ' + selected + ' class="select-option" name="' + name + '" />';
      field += '<input type="text" class="option-label" placeholder="' + opts.messages.optionLabelPlaceholder + '" value="' + values.label + '" />';
      field += '<input type="text" class="option-value" placeholder="' + opts.messages.optionValuePlaceholder + '" value="' + values.value + '" />';
      field += '<a href="javascript: void(0);" class="remove btn" title="' + opts.messages.removeMessage + '">' + opts.messages.remove + '</a>';
      field += '</li>';

      return field;
    };

    // ---------------------- UTILITIES ---------------------- //

    // delete options
    $sortableFields.on('click touchstart', '.remove', function (e) {
      e.preventDefault();
      var optionsCount = $(this).parents('.sortable-options:eq(0)').children('li').length;
      if (optionsCount <= 2) {
        alert('Error: ' + opts.messages.minOptionMessage);
      } else {
        $(this).parent('li').slideUp('250', function () {
          $(this).remove();
        });
      }
    });

    // touch focus
    $sortableFields.on('touchstart', 'input', function (e) {
      if (e.handled !== true) {
        if ($(this).attr('type') === 'checkbox') {
          $(this).trigger('click');
        } else {
          $(this).focus();
          var fieldVal = $(this).val();
          $(this).val(fieldVal);
        }
      } else {
        return false;
      }
    });

    // toggle fields
    $sortableFields.on('click touchstart', '.toggle-form', function (e) {
      e.stopPropagation();
      e.preventDefault();
      if (e.handled !== true) {
        var targetID = $(this).attr('id');
        _helpers.toggleEdit(targetID + '-item');
        e.handled = true;
      } else {
        return false;
      }
    });

    _helpers.toggleEdit = function (fieldId) {
      var field = document.getElementById(fieldId),
          toggleBtn = $('.toggle-form', field),
          editMode = $('.frm-holder', field);
      toggleBtn.toggleClass('open').parent().next('.prev-holder').slideToggle(250);
      editMode.slideToggle(250, function () {
        _helpers.save();
      });
    };

    // update preview to label
    $sortableFields.on('keyup change', 'input[name="label"]', function () {
      $('.field-label', $(this).closest('li')).text($(this).val());
    });

    // remove error styling when users tries to correct mistake
    $sortableFields.delegate('input.error', 'keyup', function () {
      $(this).removeClass('error');
    });

    // update preview for description
    $sortableFields.delegate('input[name="description"]', 'keyup', function () {
      var closestToolTip = $('.tooltip-element', $(this).closest('li'));
      if ($(this).val() !== '') {
        if (!closestToolTip.length) {
          var tt = '<span class="tooltip-element" tooltip="' + $(this).val() + '">?</span>';
          $('.toggle-form', $(this).closest('li')).before(tt);
          // _helpers.initTooltip(tt);
        } else {
            closestToolTip.attr('tooltip', $(this).val()).css('display', 'inline-block');
          }
      } else {
        if (closestToolTip.length) {
          closestToolTip.css('display', 'none');
        }
      }
    });

    _helpers.updateMultipleSelect();

    // format name attribute
    $sortableFields.delegate('input[name="name"]', 'keyup', function () {
      $(this).val(_helpers.safename($(this).val()));
      if ($(this).val() === '') {
        $(this).addClass('field_error').attr('placeholder', opts.messages.cannotBeEmpty);
      } else {
        $(this).removeClass('field_error');
      }
    });

    $sortableFields.delegate('input.fld-maxlength', 'keyup', function () {
      $(this).val(_helpers.forceNumber($(this).val()));
    });

    // Delete field
    $sortableFields.on('click touchstart', '.delete-confirm', function (e) {
      e.preventDefault();

      // lets see if the user really wants to remove this field... FOREVER
      var fieldWarnH3 = $('<h3/>').html('<span></span>' + opts.messages.warning),
          deleteID = $(this).attr('id').replace(/del_/, ''),
          delBtn = $(this),
          $field = $(document.getElementById('frm-' + deleteID + '-item')),
          toolTipPageX = delBtn.offset().left - $(window).scrollLeft(),
          toolTipPageY = delBtn.offset().top - $(window).scrollTop();

      if (opts.showWarning) {
        jQuery('<div />').append(fieldWarnH3, opts.messages.fieldRemoveWarning).dialog({
          modal: true,
          resizable: false,
          width: 300,
          dialogClass: 'ite-warning',
          open: function open() {
            $('.ui-widget-overlay').css({
              'opacity': 0.0
            });
          },
          position: [toolTipPageX - 282, toolTipPageY - 178],
          buttons: [{
            text: opts.messages.yes,
            click: function click() {
              $field.slideUp(250, function () {
                $(this).remove();
                _helpers.save();
              });
              $(this).dialog('close');
            }
          }, {
            text: opts.messages.no,
            'class': 'cancel',
            click: function click() {
              $(this).dialog('close');
            }
          }]
        });
      } else {
        $field.slideUp(250, function () {
          $(this).remove();
          _helpers.save();
        });
      }

      if ($('.form-field', $sortableFields).length === 1) {
        $stageWrap.addClass('empty');
      }
    });

    // Attach a callback to toggle required asterisk
    $sortableFields.delegate('input.required', 'click', function () {
      var requiredAsterisk = $(this).parents('li.form-field').find('.required-asterisk');
      requiredAsterisk.toggle();
    });

    // Attach a callback to toggle roles visibility
    $sortableFields.delegate('input[name="enable_roles"]', 'click', function () {
      var roles = $(this).siblings('div.available-roles'),
          enableRolesCB = $(this);
      roles.slideToggle(250, function () {
        if (!enableRolesCB.is(':checked')) {
          $('input[type="checkbox"]', roles).removeAttr('checked');
        }
      });
    });

    // Attach a callback to add new checkboxes
    $sortableFields.delegate('.add_ck', 'click', function () {
      $(this).parent().before(selectFieldOptions());
      return false;
    });

    $sortableFields.delegate('li.disabled .form-element', 'mouseenter', function () {
      _helpers.disabledTT($(this));
    });

    // Attach a callback to add new options
    $sortableFields.on('click', '.add_opt', function (e) {
      e.preventDefault();
      var $optionWrap = $(this).parents('.fields:eq(0)'),
          $multiple = $('[name="multiple"]', $optionWrap),
          $firstOption = $('.select-option:eq(0)', $optionWrap),
          name = $firstOption.attr('name'),
          isMultiple = false;

      if ($multiple.length) {
        isMultiple = $multiple.prop('checked');
      } else {
        isMultiple = $firstOption.attr('type') === 'checkbox';
      }

      $('.sortable-options', $optionWrap).append(selectFieldOptions(false, name, false, isMultiple));
      _helpers.updateMultipleSelect();
    });

    // Attach a callback to close link
    $sortableFields.on('click touchstart', '.close-field', function () {
      var fieldId = $(this).parents('li.form-field:eq(0)').attr('id');
      _helpers.toggleEdit(fieldId);
    });

    // Attach a callback to add new radio fields
    $sortableFields.delegate('.add_rd', 'click', function (e) {
      e.preventDefault();
      $(this).parent().before(selectFieldOptions(false, $(this).parents('.frm-holder').attr('id')));
    });

    $('.form-elements .fields .remove, .frmb .del-button').on('hover', function () {
      $(this).parents('li.form-field').toggleClass('delete');
    });

    // View XML
    $(document.getElementById(frmbID + '-export-xml')).click(function (e) {
      e.preventDefault();
      var xml = elem.val(),
          $pre = $('<pre />').text(xml);
      $pre.dialog({
        resizable: false,
        modal: true,
        width: 720,
        dialogClass: 'frmb-xml',
        overlay: {
          color: '#333333'
        }
      });
    });

    // Clear all fields in form editor
    $(document.getElementById(frmbID + '-clear-all')).click(function (e) {
      e.preventDefault();
      if (window.confirm(opts.messages.clearAllMessage)) {
        $sortableFields.empty();
        elem.val('');
        _helpers.save();
        var values = {
          label: [opts.messages.descriptionField],
          name: ['content'],
          required: 'true',
          description: opts.messages.mandatory
        };

        appendNewField(values);
        $sortableFields.prepend(opts.disableFields.before);
        $sortableFields.append(opts.disableFields.after);
      }
    });

    // Save Idea Template


    var triggerDevMode = false,
        keys = [],
        devCode = '68,69,86';
    // Super secret Developer Tools
    $('.save.fb-button').mouseover(function () {
      triggerDevMode = true;
    }).mouseout(function () {
      triggerDevMode = false;
    });
    $(document.documentElement).keydown(function (e) {
      keys.push(e.keyCode);
      if (keys.toString().indexOf(devCode) >= 0) {
        $('.action-links').toggle();
        $('.view-xml').toggle();
        keys = [];
      }
    });
    // Toggle Developer Mode
    $('.dev-mode-link').click(function (e) {
      e.preventDefault();
      var dml = $(this);
      $stageWrap.toggleClass('dev-mode');
      dml.parent().css('opacity', 1);
      if ($stageWrap.hasClass('dev-mode')) {
        dml.siblings('.action-links-inner').css('width', '100%');
        dml.html(opts.messages.devMode + ' ' + opts.messages.on).css('color', '#8CC63F');
      } else {
        dml.siblings('.action-links-inner').css('width', 0);
        dml.html(opts.messages.devMode + ' ' + opts.messages.off).css('color', '#666666');
        triggerDevMode = false;
        $('.action-links').toggle();
        $('.view-xml').toggle();
      }
    });

    // Toggle Edit Names
    $(document.getElementById(frmbID + '-edit-names')).click(function (e) {
      e.preventDefault();
      $(this).toggleClass('active');
      $('.name-wrap', $sortableFields).slideToggle(250, function () {
        $stageWrap.toggleClass('edit-names');
      });
    });

    // Toggle Allow Select
    $(document.getElementById(frmbID + '-allow-select')).click(function (e) {
      e.preventDefault();
      $(this).toggleClass('active');
      $('.allow-multi, .select-option', $sortableFields).slideToggle(250, function () {
        $stageWrap.toggleClass('allow-select');
      });
    });

    // Toggle Edit XML
    $(document.getElementById(frmbID + '-edit-xml')).click(function (e) {
      e.preventDefault();
      $(this).toggleClass('active');
      $('textarea.idea-template').show();
      $('.template-textarea-wrap').slideToggle(250);
      $stageWrap.toggleClass('edit-xml');
    });

    elem.parent().find('p[id*="ideaTemplate"]').remove();
    elem.wrap('<div class="template-textarea-wrap"/>');
    elem.getTemplate();
  };

  $.fn.formBuilder = function (options) {
    var form = this;
    return form.each(function () {
      var element = $(this),
          formBuilder;
      if (element.data('formBuilder')) {
        var existingFormBuilder = element.parents('.form-builder:eq(0)');
        var newElement = element.clone();
        existingFormBuilder.before(newElement);
        existingFormBuilder.remove();
        formBuilder = new FormBuilder(newElement, options);
        newElement.data('formBuilder', formBuilder);
      } else {
        formBuilder = new FormBuilder(form, options);
        element.data('formBuilder', formBuilder);
      }
    });
  };
})(jQuery);
// toXML is a jQuery plugin that turns our form editor into XML
'use strict';

(function ($) {
  'use strict';
  $.fn.toXML = function (options) {
    var defaults = {
      prepend: '',
      attributes: ['class']
    };
    var opts = $.extend(defaults, options);

    var serialStr = '',
        _helpers = {};

    _helpers.getType = function ($field) {
      var type = $('.fld-subtype', $field).val() || $field.attr('class').replace(' form-field', '');
      return type;
    };

    _helpers.hyphenCase = function (str) {
      return str.replace(/([A-Z])/g, function ($1) {
        return '-' + $1.toLowerCase();
      });
    };

    _helpers.attrString = function (attrs) {
      var attributes = [];
      for (var attr in attrs) {
        if (attrs.hasOwnProperty(attr) && attrs[attr]) {
          var attrName = _helpers.hyphenCase(attr),
              attrString = attrName + '="' + attrs[attr] + '"';
          attributes.push(attrString);
        }
      }
      return attributes.join(' ');
    };

    var fieldOptions = function fieldOptions($field) {
      var options = [];
      $('.sortable-options li', $field).each(function () {
        var $option = $(this),
            optionValue = 'value="' + $('.option-value', $option).val() + '"',
            optionLabel = $('.option-label', $option).val(),
            selected = $('.select-option', $option).is(':checked') ? ' selected="true"' : '';
        options.push('\n\t\t\t<option' + selected + ' ' + optionValue + '>' + optionLabel + '</option>');
      });
      return options.join('');
    };

    // Begin the core plugin
    this.each(function () {
      if ($(this).children().length >= 1) {
        serialStr += '<form-template>\n\t<fields>';

        // build new xml
        $(this).children().each(function () {
          var $field = $(this);
          if (!($field.hasClass('moving') || $field.hasClass('disabled'))) {
            for (var att = 0; att < opts.attributes.length; att++) {
              var roleVals = $.map($('input.roles-field:checked', $field), function (n) {
                return n.value;
              }).join(',');
              var xmlAttrs = {
                required: $('input.required', $field).is(':checked'),
                multiple: $('input[name="multiple"]', $field).is(':checked'),
                type: _helpers.getType($field),
                name: $('input.fld-name', $field).val(),
                placeholder: $('input.fld-placeholder', $field).val(),
                label: $('input.fld-label', $field).val(),
                description: $('input.fld-description', $field).val(),
                maxlength: $('input.fld-maxlength', $field).val(),
                role: roleVals,
                toggle: $('.checkbox-toggle', $field).is(':checked')
              },
                  multipleField = xmlAttrs.type.match(/(select|checkbox-group|radio-group)/),
                  attrsString = _helpers.attrString(xmlAttrs),
                  fSlash = !multipleField ? '/' : '';

              serialStr += '\n\t\t<field ' + attrsString + fSlash + '>';
              if (multipleField) {
                serialStr += fieldOptions($field);
                serialStr += '\n\t\t</field>';
              }
            }
          }
        });
        serialStr += '\n\t</fields>\n</form-template>';
      } // if "$(this).children().length >= 1"
    });
    return serialStr;
  };
})(jQuery);
// @todo this is a total mess that has to be refactored