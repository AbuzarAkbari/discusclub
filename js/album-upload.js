$(document).ready(function() {
    file_style()

    $('form').bind('submit', function(e) {
        e.preventDefault()
    })

    $('.contact input').keyup(function() {
        var value = $(this).val()
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/

        if (
            $(this)
                .parent()
                .hasClass('email')
        ) {
            if (!reg.test($(this).val())) {
                validate_animation($(this), 'error')
                error_message($(this), 'error')
            } else {
                validate_animation($(this), 'success')
                error_message($(this), 'success')
            }
            exit
        }
        if (value.length > 0) {
            validate_animation($(this), 'success')
            error_message($(this), 'success')
        } else if (value.length == 0) {
            validate_animation($(this), 'blank')
            error_message($(this), 'blank')
        } else {
            validate_animation($(this), 'error')
            error_message($(this), 'error')
        }
    })

    $('.contact input').blur(function() {
        error_message($(this), 'blank')
    })
})

function validate_animation(elem, is_valid) {
    if (is_valid != 'blank') {
        var elem_class = elem.attr('class').split('-')
        elem.attr('class', elem_class[0] + '-to-' + is_valid)
    } else {
        elem.attr('class', 'default')
    }
}

function error_message(elem, is_valid) {
    if (is_valid == 'error') {
        var msg = elem.attr('msg')
        elem
            .next()
            .text(msg)
            .show()
    } else {
        elem.next().hide()
    }
}

function file_style() {
    var wrapper = $('<div/>').css({ height: 0, width: 0, overflow: 'hidden' })
    var fileInput = $(':file').wrap(wrapper)

    fileInput.change(function() {
        $this = $(this)
    })

    $('#file')
        .click(function() {
            fileInput.click()
        })
        .show()
}

;(function() {
    var input = document.getElementById('images'),
        form = document.getElementById('image-form'),
        dropbox = document.getElementById('file'),
        formdata = false

    function showUploadedItem(source) {
        $('#image-list').html("<li><img src='" + source + "' />")
    }

    function dragEnter(evt) {
        evt.stopPropagation()
        evt.preventDefault()
    }

    function dragOver(evt) {
        evt.stopPropagation()
        evt.preventDefault()
        $('#file').css('background-position', 'center -140px')
        $('#file p')
            .text('Release to add image')
            .css('cursor', 'alias')
    }

    function dragExit(evt) {
        evt.stopPropagation()
        evt.preventDefault()
        $('#file').css('background-position', 'center 35px')
        $('#file p')
            .text('Click or Drag in an image to upload')
            .css('cursor', 'pointer')
    }

    function handleFiles(files) {
        var file = files[0]
        if (!!file.type.match(/image.*/)) {
            if (window.FileReader) {
                reader = new FileReader()
                reader.onloadend = function(e) {
                    showUploadedItem(e.target.result, file.fileName)
                }
                reader.readAsDataURL(file)
            }
        }
    }

    function drop(evt) {
        evt.stopPropagation()
        evt.preventDefault()

        var files = evt.dataTransfer.files
        var count = files.length
        // Only call the handler if 1 or more files was dropped.
        if (count > 0) {
            handleFiles(files)
        }
    }

    if (window.FormData) {
        formdata = new FormData()
    }

    // init event handlers
    dropbox.addEventListener('dragenter', dragEnter, false)
    dropbox.addEventListener('dragexit', dragExit, false)
    dropbox.addEventListener('dragover', dragOver, false)
    dropbox.addEventListener('drop', drop, false)

    input.addEventListener(
        'change',
        function(evt) {
            //document.getElementById("response").innerHTML = "Uploading . . ."
            var i = 0,
                len = this.files.length,
                img,
                reader,
                file

            for (; i < len; i++) {
                file = this.files[i]

                if (!!file.type.match(/image.*/)) {
                    if (window.FileReader) {
                        reader = new FileReader()
                        reader.onloadend = function(e) {
                            showUploadedItem(e.target.result, file.fileName)
                        }
                        reader.readAsDataURL(file)
                    }
                    if (formdata) {
                        formdata.append('images[]', file)
                    }
                }
            }
        },
        false,
    )
})()

// DEVELOPER

;('use strict')

;(function(document, window, index) {
    // feature detection for drag&drop upload
    var isAdvancedUpload = (function() {
        var div = document.createElement('div')
        return (
            ('draggable' in div || ('ondragstart' in div && 'ondrop' in div)) &&
            'FormData' in window &&
            'FileReader' in window
        )
    })()

    // applying the effect for every form
    var forms = document.querySelectorAll('.box')
    Array.prototype.forEach.call(forms, function(form) {
        var input = form.querySelector('input[type="file"]'),
            label = form.querySelector('label'),
            errorMsg = form.querySelector('.box__error span'),
            restart = form.querySelectorAll('.box__restart'),
            droppedFiles = false,
            showFiles = function(files) {
                label.textContent =
                    files.length > 1
                        ? (input.getAttribute('data-multiple-caption') || ''
                          ).replace('{count}', files.length)
                        : files[0].name
            },
            triggerFormSubmit = function() {
                var event = document.createEvent('HTMLEvents')
                event.initEvent('submit', true, false)
                form.dispatchEvent(event)
            }

        // letting the server side to know we are going to make an Ajax request
        var ajaxFlag = document.createElement('input')
        ajaxFlag.setAttribute('type', 'hidden')
        ajaxFlag.setAttribute('name', 'ajax')
        ajaxFlag.setAttribute('value', 1)
        form.appendChild(ajaxFlag)

        // automatically submit the form on file select
        input.addEventListener('change', function(e) {
            showFiles(e.target.files)
        })

        // drag&drop files if the feature is available
        if (isAdvancedUpload) {
            form.classList.add('has-advanced-upload') // letting the CSS part to know drag&drop is supported by the browser

            ;[
                'drag',
                'dragstart',
                'dragend',
                'dragover',
                'dragenter',
                'dragleave',
                'drop',
            ].forEach(function(event) {
                form.addEventListener(event, function(e) {
                    // preventing the unwanted behaviours
                    e.preventDefault()
                    e.stopPropagation()
                })
            })
            ;['dragover', 'dragenter'].forEach(function(event) {
                form.addEventListener(event, function() {
                    form.classList.add('is-dragover')
                })
            })
            ;['dragleave', 'dragend', 'drop'].forEach(function(event) {
                form.addEventListener(event, function() {
                    form.classList.remove('is-dragover')
                })
            })
            form.addEventListener('drop', function(e) {
                droppedFiles = e.dataTransfer.files // the files that were dropped
                showFiles(droppedFiles)
            })
        }

        // if the form was submitted
        form.addEventListener('submit', function(e) {
            // preventing the duplicate submissions if the current one is in progress
            if (form.classList.contains('is-uploading')) return false

            form.classList.add('is-uploading')
            form.classList.remove('is-error')

            if (isAdvancedUpload) {
                // ajax file upload for modern browsers
                e.preventDefault()

                // gathering the form data
                var ajaxData = new FormData(form)
                if (droppedFiles) {
                    Array.prototype.forEach.call(droppedFiles, function(file) {
                        ajaxData.append(input.getAttribute('name'), file)
                    })
                }

                // ajax request
                var ajax = new XMLHttpRequest()
                ajax.open(
                    form.getAttribute('method'),
                    form.getAttribute('action'),
                    true,
                )

                ajax.onload = function() {
                    form.classList.remove('is-uploading')
                    if (ajax.status >= 200 && ajax.status < 400) {
                        var data = JSON.parse(ajax.responseText)
                        form.classList.add(
                            data.success == true ? 'is-success' : 'is-error',
                        )
                        if (!data.success) errorMsg.textContent = data.error
                    } else alert('Error. Please, contact the webmaster!')
                }

                ajax.onerror = function() {
                    form.classList.remove('is-uploading')
                    alert('Error. Please, try again!')
                }

                ajax.send(ajaxData)
            } else {
                // fallback Ajax solution upload for older browsers
                var iframeName = 'uploadiframe' + new Date().getTime(),
                    iframe = document.createElement('iframe')

                $iframe = $(
                    '<iframe name="' +
                        iframeName +
                        '" style="display: none;"></iframe>',
                )

                iframe.setAttribute('name', iframeName)
                iframe.style.display = 'none'

                document.body.appendChild(iframe)
                form.setAttribute('target', iframeName)

                iframe.addEventListener('load', function() {
                    var data = JSON.parse(iframe.contentDocument.body.innerHTML)
                    form.classList.remove('is-uploading')
                    form.classList.add(
                        data.success == true ? 'is-success' : 'is-error',
                    )
                    form.removeAttribute('target')
                    if (!data.success) errorMsg.textContent = data.error
                    iframe.parentNode.removeChild(iframe)
                })
            }
        })

        // restart the form if has a state of error/success
        Array.prototype.forEach.call(restart, function(entry) {
            entry.addEventListener('click', function(e) {
                e.preventDefault()
                form.classList.remove('is-error', 'is-success')
                input.click()
            })
        })

        // Firefox focus bug fix for file input
        input.addEventListener('focus', function() {
            input.classList.add('has-focus')
        })
        input.addEventListener('blur', function() {
            input.classList.remove('has-focus')
        })
    })
})(document, window, 0)
