ag.ns("ag.mlang.field");

(function(){
    var
        multilangField = function(useTextarea)
        {
            this.extend(this, ag.ui.tool.tpl("agit-mlang-form", ".multilang"));

            this.find(useTextarea ? "input" : "textarea").remove();

            this.input = new ag.ui.field.Text(this.find("input, textarea"));
            this.langTabs = this.find(".langs a").toArray().map(elem => $(elem)); // apparently the easiest way to get a plain array of jQ objects
            this.currentTab = null;
            this.langValues = {};

            this.langTabs.forEach(tab => {
                var lang = tab.attr("data-locale").substr(0, 2);

                tab.data("lang", lang).find("span").text(lang);
                this.langValues[lang] = "";

                if (!this.currentTab)
                    this.currentTab = tab.addClass("current");

                tab.on("click", () => {
                    this.langTabs.map(tb => tb.removeClass("current"));
                    this.currentTab = tab;
                    this.input.setValue(this.langValues[lang]);
                    this.input.focus();
                    tab.addClass("current");
                });
            });

            this.input.on("focus", () => {
                this.langTabs.map(tb => tb.removeClass("current"));
                this.currentTab.addClass("current");
            });

            this.input.on("keyup blur", collectValues.bind(this));

            if (this.langTabs.length === 1)
                this.addClass("single");
        },

        sortFunc = function(tab1, tab2)
        {
            var
                lang1 = tab1.data("lang"),
                lang2 = tab2.data("lang"),
                text1 = this.langValues[lang1],
                text2 = this.langValues[lang2],
                retval = 0;

            if (text1 && text2 || (!text1 && !text2))
                retval = lang1.localeCompare(lang2);

            else if (text1 && !text2)
                retval = 1;

            else if (!text1 && text2)
                retval = -1;

            return retval;
        },

        collectValues = function()
        {
            var
                lang = this.currentTab.data("lang"),
                langText = this.input.getValue().trim();

            if (langText)
                this.langValues[lang] = langText;
            else
                delete this.langValues[lang];

            this.currentTab[langText ? "addClass" : "removeClass"]("hastext");
        };

    multilangField.prototype = Object.create(ag.ui.field.ComplexField.prototype);

    multilangField.prototype.setValue = function(value)
    {
        var langObject = ag.mlang.mlStringToObj(value);

        // NOTE: we cannot simply replace this.langValues with langObject, because
        // langObject may contain obsolete translations, which we would never get rid of.
        // So we play it safe and re-create this.langValues altogether.

        this.langValues = {};

        this.langTabs.forEach(tab => {
            var lang = tab.data("lang");

            if (langObject[lang])
                this.langValues[lang] = langObject[lang];

            tab.toggleClass("hastext", !!langObject[lang]);
        });

        this.langTabs.sort.call(this, sortFunc);

        this.input.setValue(this.langValues[this.currentTab.data("lang")]);

        this.triggerHandler("ag.field.set");
        return this;
    };

    multilangField.prototype.getValue = function()
    {
        collectValues.call(this);
        return ag.mlang.mlObjToString(this.langValues);
    };

    ag.mlang.field.Multilang = multilangField;
})();
