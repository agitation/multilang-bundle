ag.ns("ag.mlang.field");

(function(){
    var
        sortFunc = function($tab1, $tab2)
        {
            var
                lang1 = $($tab1).data("lang"),
                lang2 = $($tab2).data("lang"),
                text1 = this.langValues[lang1],
                text2 = this.langValues[lang2],
                retval = 0;

            if (text1 && text2 || (!text1 && !text2))
            {
                retval = lang1.localeCompare(lang2);
            }
            else if (text1 && !text2)
            {
                retval = 1;
            }
            else if (!text1 && text2)
            {
                retval = -1;
            }

            return retval;
        },

        collectValues = function()
        {
            var
                lang = this.$currentTab.data("lang"),
                langText = this.$input.getValue().trim();

            if (langText)
                this.langValues[lang] = langText;
            else
                delete this.langValues[lang];

            this.$currentTab[langText ? "addClass" : "removeClass"]("hastext");
        },

        multilangField = function(useTextarea)
        {
            var
                $field = ag.ui.tool.tpl("agit-mlang-form", ".multilang")
                    .find(useTextarea ? "input" : "textarea").remove().end(),
                self = this;

            this.extend(this, $field);

            this.$input = new ag.ui.field.Text($field.find("input, textarea"));
            this.$langTabs = $field.find(".langs a");
            this.$currentTab;
            this.langValues = {};

            this.$langTabs.each(function(){
                var
                    $tab = $(this),
                    lang = $tab.attr("data-locale").substr(0, 2);

                $tab.data("lang", lang).find('span').text(lang);
                self.langValues[lang] = "";

                if (!self.$currentTab)
                    self.$currentTab = $tab.addClass("current");

                $tab.on("click", function(){
                    self.$langTabs.removeClass("current");
                    self.$currentTab = $tab;
                    self.$input.setValue(self.langValues[lang]);
                    self.$input.focus();
                    $tab.addClass("current");
                });
            });

            this.$input.on("focus", function(){
                self.$langTabs.removeClass("current");
                self.$currentTab.addClass("current");
            });

            this.$input.on("keyup blur", function(ev){
                collectValues.call(self);
            });
        };

    multilangField.prototype = Object.create(ag.ui.field.ComplexField.prototype);

    multilangField.prototype.setValue = function(value)
    {
        var
            langObject = ag.mlang.mlStringToObj(value),
            self = this;

        // NOTE: we cannot simply replace this.langValues with langObject, because
        // langObject may contain obsolete translations, which we would never get rid of.
        // So we play it safe and re-create this.langValues altogether.

        this.langValues = {};

        this.$langTabs.each(function(){
            var
                $tab = $(this),
                lang = $tab.data("lang");

            langObject[lang] && (self.langValues[lang] = langObject[lang]);
            $tab.toggleClass("hastext", !!langObject[lang]);
        });

        self.$langTabs.sort.call(this, sortFunc);

        self.$input.setValue(self.langValues[self.$currentTab.data("lang")]);

        return this;
    };

    multilangField.prototype.getValue = function()
    {
        collectValues.call(this);
        return ag.mlang.mlObjToString(this.langValues);
    };

    ag.mlang.field.Multilang = multilangField;
})();
