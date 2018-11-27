//Survey
    //.StylesManager
    //.applyTheme();



var defaultThemeColors = Survey
    .StylesManager
    .ThemeColors["default"];
defaultThemeColors["$main-color"] = "rgba(232,96,83, 1)";
defaultThemeColors["$main-hover-color"] = "rgba(232,96,83, 1)";
defaultThemeColors["$text-color"] = "#4a4a4a";
defaultThemeColors["$header-color"] = "rgba(232,96,83, 1)";

defaultThemeColors["$header-background-color"] = "#4a4a4a";
defaultThemeColors["$body-container-background-color"] = "#f8f8f8";
defaultThemeColors["element.style"] = "rgba(232,96,83, 1)";

Survey
    .StylesManager
    .applyTheme();


var json = {
    "elements": [
        {
            "type": "sortablelist",
            "name": "interests",
            "title": "Which of these interests you? (most preferred to least preferred)",
            "isRequired": true,
            "choices": ["Cancer Research", "Religion", "Domestic Violence", "Poverty", "Animals",
                        "Disaster Relief", "Homeless", "Children"]
        },

        {
            "type": "sortablelist",
            "name": "moneyReached",
            "title": "How far would you like your money to reach? (most preferred to least preferred)",
            "isRequired": true,
            "choices": ["Locally", "Regionally", "Nationally", "Globally"]
        },
                
        {
            "type": "sortablelist",
            "name": "religions",
            "title": "How far would you like your money to reach? (most preferred to least preferred)",
            "isRequired": true,
            "choices": ["Christianity", "Judaism", "Islam", "Buddhism","Hinduism","Other",
                        "Prefer Not To Answer"]
        }


    ]



};



window.survey = new Survey.Model(json);

survey
    .onComplete
    .add(function (result) {
        document
            .querySelector('#surveyResult')
            .innerHTML = "result: " + JSON.stringify(result.data);
    });

$("#surveyElement").Survey({model: survey});
