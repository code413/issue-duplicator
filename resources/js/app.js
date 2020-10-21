require('./bootstrap')
import Choices from 'choices.js'

document.querySelectorAll('.js-select-repo').forEach((element) => {
    let options = JSON.parse(element.dataset.options)

    new Choices(element, {
        choices: options.map((option) => {
            return {
                value: option.full_name,
                customProperties: option
            }
        }),
        callbackOnCreateTemplates: function (template) {
            return {
                item: (classNames, data) => {
                    return template(`
          <div class="flex items-center ${classNames.item} ${
                        data.highlighted
                            ? classNames.highlightedState
                            : classNames.itemSelectable
                    } ${
                        data.placeholder ? classNames.placeholder : ''
                    }" data-item data-id="${data.id}" data-value="${data.value}" ${
                        data.active ? 'aria-selected="true"' : ''
                    } ${data.disabled ? 'aria-disabled="true"' : ''}>
            <span>` +
            ((data.customProperties.owner) ? `<div class="w-5 h-5 rounded-full bg-no-repeat bg-cover mr-2" style="background-image:url(${data.customProperties.owner.avatar_url})"></div>` : '')
            + `</span> ${data.label}
          </div>
        `);
                },
                choice: (classNames, data, a, b, c) => {
                    return template(`
          <div class="flex items-center ${classNames.item} ${classNames.itemChoice} ${
                        data.disabled ? classNames.itemDisabled : classNames.itemSelectable
                    }" data-select-text="${this.config.itemSelectText}" data-choice ${
                        data.disabled
                            ? 'data-choice-disabled aria-disabled="true"'
                            : 'data-choice-selectable'
                    } data-id="${data.id}" data-value="${data.value}" ${
                        data.groupId > 0 ? 'role="treeitem"' : 'role="option"'
                    }>
            <span>` +
            ((data.customProperties.owner) ? `<div class="w-5 h-5 rounded-full bg-no-repeat bg-cover mr-2" style="background-image:url(${data.customProperties.owner.avatar_url})"></div>` : '')
            + `</span> ${data.label}
          </div>
        `)
                },
            }
        },
    })
})
