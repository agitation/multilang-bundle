ag.ns("ag");

ag.mlang =
{
    u : function(string) // just a shortcut
    {
        return ag.mlang.mlStringTranslate(string, ag.cfg.locale);
    },

    mlObjToString : function(obj)
    {
        var string = "";

        Object.keys(obj).forEach(function(key){
            key.length === 2 && (string += "[:" + key + "]" + obj[key]);
        });

        return string;
    },

    mlStringToObj : function(string)
    {
        var
            regex = new RegExp("\\[:(?=[a-z]{2}\\])", "g"),
            obj = {};

        if (typeof(string) === "string")
        {
            string.split(regex).forEach(function(part){
                var
                    key = part.substr(0, 2),
                    string = part.substr(3);

                if (part.length >= 3 && part.substr(0,3).match(/[a-z]{2}\]/))
                {
                    obj[key] = string;
                }
            });
        }

        return obj;
    },

    mlStringTranslate : function(string, locale)
    {
        var
            lang = locale.substr(0, 2),
            fallbackLang = ag.cfg.locale.substr(0, 2),
            obj,
            outString = string;

        if (typeof(string) === "string" && string.match(/\[:[a-z]{2}\]/))
        {
            obj = ag.mlang.mlStringToObj(string);

            if (typeof(obj[lang]) === "string")
            {
                outString = obj[lang];
            }
            else if (typeof(obj[fallbackLang]) === "string")
            {
                outString = obj[fallbackLang];
            }
            else if (typeof(obj.en) === "string")
            {
                outString = obj.en;
            }
            else if (Object.keys(obj).length)
            {
                outString = obj[Object.keys(obj)[0]];
            }
            else
            {
                outString = "";
            }
        }

        return outString;
    }
};

// register output filter
ag.ui.tool.fmt.filters.push(function(string){
    return ag.mlang.mlStringTranslate(string, ag.cfg.locale);
});


// console.log(ag.mlang.mlStringTranslate("[:de]foo[:en]bar", "de_AT")); // "foo"
// console.log(ag.mlang.mlStringTranslate("[:de]foo[:en]bar", "it_IT")); // "foo"
// console.log(ag.mlang.mlStringTranslate("[:de][:en]bar", "de_DE")); // ""
// console.log(ag.mlang.mlStringTranslate("[de]foo[:en]bar", "de_DE")); // "bar"
// console.log(ag.mlang.mlStringTranslate("[defoo[:en]bar", "de_DE")); // "bar"
// console.log(ag.mlang.mlStringTranslate("[:defoo[:en]bar", "de_DE")); // "bar"
// console.log(ag.mlang.mlStringTranslate("foobar", "de_DE")); // "foobar"
//
// console.log(ag.mlang.mlStringToObj("[:de]foo[:en]bar")); // { de : "foo", en : "bar" }
// console.log(ag.mlang.mlStringToObj("[:de]foo[:en]bar")); // { de : "foo", en : "bar" }
// console.log(ag.mlang.mlStringToObj("[:de][:en]bar")); // { de : "", en : "bar" }
// console.log(ag.mlang.mlStringToObj("[de]foo[:en]bar")); // { en : "bar" }
// console.log(ag.mlang.mlStringToObj("[defoo[:en]bar")); // { en : "bar" }
// console.log(ag.mlang.mlStringToObj("[:defoo[:en]bar")); // { en : "bar" }
// console.log(ag.mlang.mlStringToObj("foobar")); // { }
