$(document).ready(function() {
    let MostPopularAnswersLabelsData = $("#MostPopularAnswersLabels").text();
    let MostPopularAnswersLabels = JSON.parse(MostPopularAnswersLabelsData)

    let MostPopularAnswersValuessData = $("#MostPopularAnswersValues").text();
    let MostPopularAnswersValues = JSON.parse(MostPopularAnswersValuessData)

    let MostPopularAnswersColorsData = $("#MostPopularAnswersColorsData").text();
    let MostPopularAnswersColors = JSON.parse(MostPopularAnswersColorsData)

    var ctx = $("#MostPopularAnswers");
    var myLineChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: MostPopularAnswersLabels,
            datasets: [{
                data: MostPopularAnswersValues,
                backgroundColor: MostPopularAnswersColors
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Самые популярные ответы'
            }
        }
    });
});

$(document).ready(function() {

    let QuestionsOftenLeftLabelsData = $("#QuestionsOftenLeftLabels").text();
    let QuestionsOftenLeftLabels = JSON.parse(QuestionsOftenLeftLabelsData)

    let QuestionsOftenLeftValuesData = $("#QuestionsOftenLeftValues").text();
    let QuestionsOftenLeftValues = JSON.parse(QuestionsOftenLeftValuesData)

    let MostPopularAnswersColorsData = $("#MostPopularAnswersColorsData").text();
    let MostPopularAnswersColors = JSON.parse(MostPopularAnswersColorsData)

    var ctx = $("#QuestionsOftenLeft");
    var myLineChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: QuestionsOftenLeftLabels,
            datasets: [{
                data: QuestionsOftenLeftValues,
                backgroundColor: MostPopularAnswersColors
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Вопросы на которых чаще всего бросают отвечать'
            }
        }
    });
});
