function createToolTip(series) {
    var tooltipType = 'Score Graph';
    var tooltipsShownCounter = 0;

    if (series?.tooltip) {
    series.tooltip.getFillFromObject = false;
    series.tooltip.background.fill = am4core.color('#CEB1BE');
    series.tooltip.background.fill = am4core.color('#ffffff');
    series.slices.template.tooltipHTML = `<div style="background-color:white">
                                        <div style="padding:5px">
                                            <div style="text-align:center;font-family:OpenSans;font-style: inherit;font-width: normal;font-weight:600;font-size: 14px;line-height: 16px;color: #000000">
                                                {category} {value}%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                  </div>`;


        series?.tooltip?.events.on('shown', (event) => {

            tooltipsShownCounter++;
            if (tooltipsShownCounter % 10 === 0) {
                mixPanel.trackTooltip(tooltipType, tooltipsShownCounter);
            }
        });
    }
}

function setMaxValue(maxValue, data) {
    maxValue = Math.max.apply(Math, data.map((d) => d.volume));
    maxValue = maxValue + maxValue * 0.1;
    maxValue = Math.ceil(maxValue / 100) * 100;

    return maxValue;
}

function createSeries(chart, name, color, roundCorner = false, tooltipsShownCounter = 0) {
    var colWidth = 11;
    const series = chart.series.push(new am4charts.ColumnSeries());
        series.name = name;
        series.dataFields.valueY = name.toLowerCase() + 'Count';
        series.dataFields.value = name.toLowerCase();
        series.dataFields.dateX = 'month';
        series.dataFields.categoryX = 'month';
        series.sequencedInterpolation = true;

    if (roundCorner) {
        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
    }
    series.stacked = true;

    series.columns.template.width = colWidth;
    series.columns.template.fill = am4core.color(color); // font color
    series.columns.template.stroke = am4core.color(color); // horizontal grid color

    // for development
    // series.columns.template.showTooltipOn = 'always';
    series.columns.template.tooltipHTML = `<div style="width: 130px; background: #fff; border-left:2px solid #660091">
            <div style="padding:0.6rem">
                <div style="font-family:OpenSans;font-style: normal;font-width: normal;font-weight:300;font-size: 1.2rem; line-height: 1.6rem;color: #000000">
                    <div>
                        <span style="color: #E64747;">●</span>
                        <span style="display: inline-block; width: 7rem;">Detractors:</span>
                        <span style="float: right;color: #E64747;">{negative}%</span>
                    </div>
                    <div>
                        <span style="color: #BDBDBD;">●</span>
                        <span style="display: inline-block; width: 7rem;">Neutral:</span>
                        <span style="float: right;color: #BDBDBD;">{neutral}%</span>
                    </div>
                    <div>
                        <span style="color: #55A73F;">●</span>
                        <span style="display: inline-block; width: 7rem;">Promoters:</span>
                        <span style="float: right;color: #55A73F;">{positive}%</span>
                    </div>
                </div>
            </div>
        </div>`;

    if (series.tooltip) {
        series.tooltip.getFillFromObject = false;
        series.tooltip.width = 135;
        series.tooltip.background.fill = am4core.color('#ffffff');
        series.tooltip.background.cornerRadius = 0;
        series.tooltip.label.padding(0, 0, 0, 0);

        series?.tooltip?.events.on('shown', (event) => {

            tooltipsShownCounter++;
            if (tooltipsShownCounter % 10 === 0) {
                this.mixPanel.trackTooltip(this.tooltipType, this.tooltipsShownCounter);
            }
        });
    }

    // Add label
    const labelBullet = series.bullets.push(new am4charts.LabelBullet());
    labelBullet.label.text = '{valueY}';
    labelBullet.locationY = 0.5;
    labelBullet.label.hideOversized = true;

    return series;
}

function startRatingPieShart(selector, chartData1, chartData2) {
    var withLegend = false;
    var size = 1;
    var chartData =  chartData1;


    const chartParent      = am4core.create(document.querySelector(selector), am4core.Container);
    chartParent.width  = am4core.percent(100 * size);
    chartParent.height = am4core.percent(100 * size);
    chartParent.layout = 'absolute';
    const chart = chartParent.createChild(am4charts.PieChart);
    // Let's cut a hole in our Pie chart the size of 40% the radius
    chart.innerRadius = am4core.percent(66);
    // chart.data = [{category: 'Positive', value : 40}, {category: 'Neutral', value : 20}, {category: 'Negative', value : 40}];
    chart.data = chartData;
    // Add and configure Series
    const pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = 'value';
    pieSeries.dataFields.category = 'category';
    pieSeries.slices.template.clickable = false;
    pieSeries.slices.template.strokeWidth = 0;
    pieSeries.slices.template.strokeOpacity = 0;
    pieSeries.labels.template.disabled = true;
    pieSeries.ticks.template.disabled = true;
    // pieSeries.opacity = 0.2;
    pieSeries.colors.list = [am4core.color('#E9CFCF'), am4core.color('#D0D0D0'), am4core.color('#D3E4CF')];

    // pieSeries.slices.template.adapter.add('fill', (fill, slice) => {
    //     // @ts-ignore
    //     if (slice.dataItem.properties.category === 'left') {
    //         const gradient = new am4core.LinearGradient();
    //         gradient.addColor(am4core.color('#3d00b9'));
    //         gradient.addColor(am4core.color('#a360fe'));
    //         gradient.rotation = 90;
    //         return gradient;
    //     }else{
    //         const gradient = new am4core.LinearGradient();
    //         gradient.addColor(am4core.color('#06858d'));
    //         gradient.addColor(am4core.color('#90faf3'));
    //         gradient.rotation = 90;
    //         return gradient;
    //     }
    // });

    chart.width = am4core.percent(66 * size);
    chart.height = am4core.percent(66 * size);
    chart.x = am4core.percent(50);
    chart.y = am4core.percent(50);
    chart.horizontalCenter = 'middle';
    chart.verticalCenter = 'middle';
    chart.rotation = -30;
    if ( withLegend ) {
        const label = pieSeries.createChild(am4core.Label);
        // label.text = '17%';
        label.horizontalCenter = 'middle';
        label.verticalCenter = 'middle';
        label.fontSize = 18;
        label.fill = am4core.color('#00aa9b');
    }

    const chart2 = chartParent.createChild(am4charts.PieChart);
    // Let's cut a hole in our Pie chart the size of 40% the radius
    chart2.innerRadius = am4core.percent(56);
    chart2.data = chartData2;
    // chart2.data = data.overall_star_rating;
    chart2.rotation = -30;
    chart2.width = am4core.percent(100 * size);
    chart2.height = am4core.percent(100 * size);
    chart2.x = am4core.percent(50);
    chart2.y = am4core.percent(50);
    chart2.horizontalCenter = 'middle';
    chart2.verticalCenter = 'middle';
    // Add and configure Series
    const pieSeries2 = chart2.series.push(new am4charts.PieSeries());

    pieSeries2.dataFields.value = 'value';
    pieSeries2.dataFields.category = 'category';
    pieSeries2.slices.template.clickable = false;
    pieSeries2.slices.template.strokeWidth = 2;
    pieSeries2.slices.template.stroke = am4core.color('#F7F7F7');
    pieSeries2.slices.template.strokeOpacity = 1;
    if (withLegend) {
        // chart.legend = new am4charts.Legend();
        pieSeries2.labels.template.disabled = false;
        pieSeries2.labels.template.rotation = 30;
        pieSeries2.ticks.template.disabled = false;
        pieSeries2.labels.template.fontFamily = 'Inter';
        pieSeries2.labels.template.fontSize = '11px';
        pieSeries2.alignLabels = false;
        pieSeries2.labels.template.text = '{category} {value}%';
        pieSeries2.labels.template.maxWidth = 60;
        pieSeries2.labels.template.wrap = true;
    } else {
        pieSeries2.ticks.template.disabled = true;
        pieSeries2.labels.template.disabled = true;
    }
    // pieSeries2.alignLabels = false;
    // pieSeries2.labels.template.bent = true;
    pieSeries2.colors.list = [am4core.color('#E64747'), am4core.color('#FF9999'),
        am4core.color('#BDBDBD'), am4core.color('#A5D498'), am4core.color('#55A73F')];

    createToolTip(pieSeries2);
    createToolTip(pieSeries);
}

function barsGraphChart(selector, data) {
    var maxValue = setMaxValue(0, data);

    var withLegend = true;
    var tooltipsShownCounter = 0;

    const container = am4core.create(selector, am4core.Container);
    container.width = am4core.percent(100);
    container.height = am4core.percent(100);
    container.layout = 'none';

    const chart = container.createChild(am4charts.XYChart);
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.disabled = true;
    chart.legend.markers.template.disabled = true;

    // Add data
    chart.data = data;

    // Create axes
    const categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = 'month';
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.grid.template.stroke = am4core.color('#ffffff'); // horizontal grid color
    categoryAxis.renderer.labels.template.fill = am4core.color('#7C828B'); // font color
    categoryAxis.renderer.labels.template.fontSize = '11px'; // font size
    categoryAxis.renderer.labels.template.fontFamily = 'Inter'; // font family
    categoryAxis.renderer.labels.template.fontWeight = '100'; // font weight
    categoryAxis.renderer.minGridDistance = 10; // minimize distance between values to show all labels
    categoryAxis.startLocation = 0; // full graph display , no padding , no margins
    categoryAxis.renderer.labels.template.disabled = false;
    categoryAxis.cursorTooltipEnabled = false; // hide axis black tooltip

    const valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    valueAxis.renderer.labels.template.disabled = false;
    valueAxis.renderer.grid.template.stroke = am4core.color('#80879b'); // horizontal grid color
    valueAxis.renderer.labels.template.fill = am4core.color('#7C828B'); // font color
    valueAxis.renderer.labels.template.fontSize = '11px'; // font size
    valueAxis.renderer.labels.template.fontFamily = 'Inter'; // font family
    valueAxis.renderer.labels.template.fontWeight = 'normal'; // font weight
    valueAxis.min = 0; // define the min y-value
    valueAxis.max = this.maxValue; // define the max y-value
    valueAxis.renderer.baseGrid.disabled = true; // remove graph base line above the x -labels
    valueAxis.cursorTooltipEnabled = false; // hide axis black tooltip

    createSeries(chart, 'Negative', '#E64747');
    createSeries(chart, 'Neutral', '#BDBDBD');
    createSeries(chart, 'Positive', '#55A73F', true);

    if (withLegend) {
        chart.legend = new am4charts.Legend();
    }
}

function gengraph(chart, columnX, maxValue = 100 ) {

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineY.stroke = am4core.color('#ffffff'); // hide horizontal guide for cursor
    chart.cursor.lineY.strokeWidth = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.dateFormatter.inputDateFormat = 'MM/yyyy';
    const dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.title.text = 'Month';
    dateAxis.renderer.grid.template.stroke = am4core.color('#ffffff'); // horizontal grid color
    dateAxis.renderer.labels.template.fill = am4core.color('#7C828B'); // font color
    dateAxis.renderer.labels.template.fontSize = '9px'; // font size
    dateAxis.renderer.labels.template.fontFamily = 'Inter'; // font family
    dateAxis.renderer.labels.template.fontWeight = '100'; // font weight
    dateAxis.baseInterval = {
        count: 1,
        timeUnit: 'month'
    };
    // minimize distance between values to show all labels

    dateAxis.renderer.labels.template.disabled = false;
    dateAxis.cursorTooltipEnabled = false; // hide axis black tooltip
    dateAxis.startLocation = 0.5; // full graph display , no padding , no margins
    dateAxis.endLocation = 0.5;
    dateAxis.dateFormats.setKey('month', 'MMM yy');
    dateAxis.dateFormatter = new am4core.DateFormatter();
    dateAxis.dateFormatter.dateFormat = 'MM yyyy';


    // define y- axis
    const valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.grid.template.stroke = am4core.color('#80879b'); // horizontal grid color
    valueAxis.renderer.labels.template.fill = am4core.color('#7C828B'); // font color
    valueAxis.renderer.labels.template.fontSize = '9px'; // font size
    valueAxis.renderer.labels.template.fontFamily = 'Inter'; // font family
    valueAxis.renderer.labels.template.fontWeight = 'normal'; // font weight
    valueAxis.min = 0; // define the min y-value
    valueAxis.max = maxValue; // define the max y-value
    valueAxis.renderer.baseGrid.disabled = true; // remove graph base line above the x -labels
    valueAxis.cursorTooltipEnabled = false; // hide axis black tooltip
}

function create_line(lineColor, columnY, label, columnX, chart) {
    const volume = chart.series.push(new am4charts.LineSeries());
    volume.dataFields.dateX = columnX;
    volume.dataFields.valueY = columnY;
    volume.stroke = am4core.color(lineColor);
    volume.fill = am4core.color(lineColor);
    volume.strokeWidth = 1;
    // enable html tooltip with white background
    volume.tooltip.getFillFromObject = false;
    volume.tooltip.background.fill = am4core.color('#ffffff');
    volume.tooltip.background.cornerRadius = 0;
    volume.tooltip.label.padding(0, 0, 0, 0);

    volume.adapter.add('tooltipHTML', (html, target) => {
        if (target.tooltipDataItem && target.tooltipDataItem.dataContext) {
            let context = target.tooltipDataItem.dataContext;
            const tooltipData = context.month;

            let htmlStr = `<div style="border-left:2px solid ${lineColor}">
                            <div style="padding:1rem">
                                <div style="font-family: 'Montserrat-Medium';font-style: normal;font-width: normal;font-size: 11px;line-height: 20px;color: #26252D;opacity: 0.6">
                                    ${tooltipData}
                                </div>
                                <div style="font-family:'Montserrat-Medium';font-style: normal;font-width: normal;font-weight:300;font-size: 1.2rem; line-height: 1.6rem;color: #000000">
                                ${label} &nbsp;&nbsp;&nbsp;&nbsp;{valueY}
                                </div>
                            </div>
                      </div>`;
            return htmlStr;
        } else {
            return '';
        }
    })

    const shadow = volume.tooltip.background.filters.getIndex(0);
    shadow.dx = 0;
    shadow.dy = 1;
    shadow.blur = 3;
    shadow.color = am4core.color('#66666666');

    // bullet
    const bullet = volume.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color(lineColor);
    bullet.circle.strokeWidth = 2;
    bullet.fillOpacity = 0;
    bullet.strokeOpacity = 0;

    const bulletState = bullet.states.create('hover');
    bulletState.properties.scale = 0.5;
    bulletState.properties.fillOpacity = 1;
    bulletState.properties.strokeOpacity = 1;
    // series[columnY] = volume;
}

function scatteredGraph(selector, data, maxValue = 100, selectedProduct) {
    const container = am4core.create(document.querySelector(selector), am4core.Container);
    let tooltipsShownCounter = 0;

    container.width = am4core.percent(100);
    container.height = am4core.percent(100);
    container.layout = 'none';

    const chart = container.createChild(am4charts.XYChart);
    chart.data = data;

    // Create axes
    const xAxis = chart.xAxes.push(new am4charts.ValueAxis());
    // xAxis.renderer.grid.template.location = 0;
    // xAxis.dateFormatter.dateFormat = 'yyyy';
    xAxis.renderer.grid.template.stroke = am4core.color('#ffffff'); // horizontal grid color
    xAxis.renderer.labels.template.fill = am4core.color('#7C828B'); // font color
    xAxis.renderer.labels.template.fontSize = '9px'; // font size
    xAxis.renderer.labels.template.fontFamily = 'Inter'; // font family
    xAxis.renderer.labels.template.fontWeight = '100'; // font weight
    xAxis.renderer.minGridDistance = 100; // minimize distance between values to show all labels
    xAxis.min = 0; // define the min y-value
    xAxis.max = maxValue; // define the max y-value
    xAxis.renderer.labels.template.disabled = false;
    xAxis.cursorTooltipEnabled = false; // hide axis black tooltip

    const yAxis = chart.yAxes.push(new am4charts.ValueAxis());
    yAxis.renderer.grid.template.stroke = am4core.color('#80879b'); // horizontal grid color
    yAxis.renderer.labels.template.fill = am4core.color('#7C828B'); // font color
    yAxis.renderer.labels.template.fontSize = '9px'; // font size
    yAxis.renderer.labels.template.fontFamily = 'Inter'; // font family
    yAxis.renderer.labels.template.fontWeight = 'normal'; // font weight
    yAxis.renderer.minGridDistance = 25;
    yAxis.renderer.minVerticalGap  = 25;
    yAxis.min = 0; // define the min y-value
    yAxis.max = 100; // define the max y-value
    yAxis.renderer.baseGrid.disabled = true; // remove graph base line above the x -labels
    yAxis.cursorTooltipEnabled = false; // hide axis black tooltip

    // Create series
    const series1 = chart.series.push(new am4charts.LineSeries());
    series1.dataFields.valueY = 'sentiment';
    series1.dataFields.valueX = 'volume';
    // @ts-ignore
    series1.dataFields.tooltipData = 'tooltip';
    series1.strokeOpacity = 0;
    series1.cursorTooltipEnabled = false;

    if (series1.tooltip) {
        series1.tooltip.label.interactionsEnabled = true;
        series1.tooltip.keepTargetHover = true;
        series1.tooltip.getFillFromObject = false;
        series1.tooltip.pointerOrientation = 'vertical';
        series1.tooltip.background.fill = am4core.color('#ffffff');
        series1.tooltip.background.cornerRadius = 0;
        series1.tooltip.label.padding(0, 0, 0, 0);
        series1.tooltip.label.interactionsEnabled = true;

        // series1?.tooltip?.events.on('up', (event)=> {
        //     const uuid = (event?.target?.dataItem as any).tooltipData?.uuid;
        //     // if (uuid && (event?.event as any)?.path[0]?.name === 'tooltip_click') {
        //     //     this.tooltipProductSelected.emit(uuid);
        //     // }
        // });

        const shadow = series1.tooltip.background.filters.getIndex(0);
        shadow.dx = 0;
        shadow.dy = 1;
        shadow.blur = 3;
    }


    const bullet1 = series1.bullets.push(new am4charts.CircleBullet());
    bullet1.fill = am4core.color('#660091');
    bullet1.stroke = am4core.color('#660091');

    bullet1.circle.adapter.add('radius', (html, target) => {
        return (target?.tooltipDataItem?.dataContext)?.uuid === selectedProduct
            ? 6 : 4;
    });
    bullet1.circle.adapter.add('fill', (html, target) => {
        return (target?.tooltipDataItem?.dataContext)?.uuid === selectedProduct
            ? am4core.color('#ffffff') : am4core.color('#660091');
    });
    bullet1.circle.adapter.add('strokeWidth', (html, target) => {
        return (target?.tooltipDataItem?.dataContext)?.uuid === selectedProduct
            ? 2 : 0;
    });


    bullet1.events.on('over', (event) => {
        console.log(event.target.circle.radius);
        event.target.circle.radius = 8;
        console.log(event.target.circle.radius);
    });
    bullet1.events.on('out', (event) => {
        event.target.circle.radius = 4;
    });
    bullet1.adapter.add('tooltipHTML', (html, target) => {
        if (target.tooltipDataItem && target.tooltipDataItem.dataContext) {
            let context = target.tooltipDataItem.dataContext;
            const tooltipData = context.tooltip;
            let list = '';
            for (const i in tooltipData.list) {
                list += `<li>
                            <div class="label">${i}</div>
                            <div class="value">${ tooltipData.list[i]}</div>
                        </li>`;
            }
            return `
             <div class="simpleTooltip">
                <div class="brand">${tooltipData.name}</div>
                <ul>
                    ${list}
                </ul>
            </div>
            `;
        } else {
            return '';
        }
    });


    // Add cursor
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.maxTooltipDistance = -1;
    // chart.cursor.behavior = "zoomXY";

    const labelBullet = series1.bullets.push(new am4charts.LabelBullet());
    labelBullet.label.paddingTop = 25;
    labelBullet.label.fontSize = 10;
    labelBullet.label.fontWeight = 700;
    // labelBullet.label.text = '{name}';
    labelBullet.label.adapter.add('text', (html, target) => {
        let name = (target?.dataItem?.dataContext).tooltip.name || '';
        name = name.length > 20 ? name.substring(0, 20) + '...' : (name || '');
        return name;
    });
}

function overtimeTopicGraph(selector, data, size = 1, stroke, data2 = []) {
    // container?.dispose();
    document.querySelector(selector).parentElement.parentElement.style.background = `linear-gradient( 0deg, ${stroke}, hsla(0,0%,100%,0) 80%)`;
    const container = am4core.create(document.querySelector(selector), am4core.Container);
    container.width = am4core.percent(106 * size);
    container.height = am4core.percent(66 * size);
    container.layout = 'absolute';
    const chart = container.createChild(am4charts.XYChart);
    chart.width = am4core.percent(100 * size);
    chart.height = am4core.percent(100 * size);
    container.paddingLeft = -14;
    const valueAxis = chart.yAxes.push(new am4charts.ValueAxis());


    chart.dateFormatter.inputDateFormat = 'MM/yyyy';
    const dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.baseInterval = {
        count: 1,
        timeUnit: 'month'
    };
    // minimize distance between values to show all labels
    dateAxis.cursorTooltipEnabled = false; // hide axis black tooltip
    dateAxis.dateFormats.setKey('month', 'MMM yy');
    dateAxis.dateFormatter = new am4core.DateFormatter();
    dateAxis.dateFormatter.dateFormat = 'MM yyyy';
    dateAxis.renderer.grid.template.strokeWidth = 0; // no vertical grid
    dateAxis.renderer.labels.template.fill = am4core.color('#7f848c'); // font color
    dateAxis.renderer.labels.template.fontSize = '8px'; // font size
    dateAxis.renderer.labels.template.fontFamily = 'OpenSans'; // font family
    dateAxis.renderer.labels.template.fontWeight = '100'; // font weight
    dateAxis.renderer.minGridDistance = 10; // minimize distance between values to show all labels
    dateAxis.startLocation = 0.5; // full graph display , no padding , no margins
    dateAxis.endLocation = 0.5;
    dateAxis.renderer.labels.template.opacity = 0;

    // valueAxis.renderer.labels.template.fill = am4core.color('#7f848c'); // font color
    valueAxis.renderer.labels.template.fontSize = '8px'; // font size
    valueAxis.renderer.labels.template.fontFamily = 'OpenSans'; // font family
    valueAxis.renderer.labels.template.fontWeight = 'normal'; // font weight
    valueAxis.renderer.grid.template.disabled = true; // disable normal behavior of the grid
    valueAxis.renderer.labels.template.disabled = true; // disable normal behavior of the grid
    valueAxis.renderer.grid.template.strokeWidth = 0;
    valueAxis.renderer.labels.template.opacity = 0;
    valueAxis.renderer.baseGrid.disabled = true; // remove graph base line above the x -labels

    // create volume graph
    const volume = chart.series.push(new am4charts.LineSeries());
    volume.dataFields.dateX = 'date';
    volume.dataFields.valueY = 'sentiment';
    volume.stroke = am4core.color(stroke);
    volume.fill = am4core.color('#F7F7F7');
    volume.strokeWidth = 1;
    volume.fillOpacity = 0;
    volume.data = data;

    if ( data2.length > 0 ) {
        const volume2 = chart.series.push(new am4charts.LineSeries());
        volume2.dataFields.dateX = 'date';
        volume2.dataFields.valueY = 'sentiment';
        volume2.stroke = am4core.color('#AB00C7');
        volume2.fill = am4core.color('#F7F7F7');
        volume2.strokeWidth = 1;
        volume2.fillOpacity = 0;
        volume2.data = data2;
        volume.stroke = am4core.color('#1D60FF');
    }

    // chart.data = data2;
}

function getAvarage(array, property) {
    let avarage = array.map(obj => {return obj[property] });
        avarage = avarage.reduce((a, b) => a + b, 0) ;
        avarage = (avarage / array.length).toFixed(0);
    return avarage;
}

function convertDate(month) {
    let date = moment(month, 'MM/yyyy');
        date = date.format('MMM, yy');
    return date;
}

function imageExists(image_url){
    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();
    console.log(http.status);
    return http.status != 200;
}

(function($) {
    function drawOverview(parentSelectorId, productGuid, urlParams, currentProduct) {
        am4core.addLicense('CH211379993');

        let biggestHeight = 0;
        $('.section__overview__top_info').each(function() {
            if ($( this ).outerHeight() > biggestHeight)
                biggestHeight = $( this ).outerHeight();
        })
        $('.section__overview__top_info').height(biggestHeight);



        /**
         * Product Monthly Rank
         * **/
   
        let json = $('#product_monthly_rank').data('info');
    
            let tempData     = [];
            let arrayOfDates = Object.keys(json.values);

            am4core.addLicense('CH211379993');
            am4core.useTheme(am4themes_animated);

            let chart        = am4core.create((document.querySelector(parentSelectorId + ' #rankOverTime')), am4charts.XYChart);
            gengraph(chart, 'date', Math.max(...Object.values(json.values)) + 100);

            if (json){
                for (var i in json.values) {
                    // for (var item in data) {
                    if (json.values[i] !== null)
                        tempData.push(JSON.parse(`{ "rank": ${json.values[i]},"date": "${i}","month": "${convertDate(i)}"}`));
                };

                let currentRankChange = 0;
                if (json.values[arrayOfDates[arrayOfDates.length - 1]] == null ||  json.values[arrayOfDates[arrayOfDates.length - 2]] == null) {
                    currentRankChange = 0;
                } else {
                    currentRankChange = json.values[arrayOfDates[arrayOfDates.length - 1]] - json.values[arrayOfDates[arrayOfDates.length - 2]];
                }
                let currentRankChangeClass = currentRankChange < 0 ? 'up mark__gr' : 'down mark__red';
                    currentRankChangeClass = currentRankChange === 0 ? '' : currentRankChangeClass;

                $(parentSelectorId + ' p[data-id="currentRank"]').text(json.rank);
                $(parentSelectorId + ' span[data-id="rankOutOf"]').text('/ ' + json.total);
                $(parentSelectorId + ' span[data-id="currentRankChange"]').text( currentRankChange );
                $(parentSelectorId + ' span[data-id="currentRankChange"]').addClass( currentRankChangeClass );

                create_line('#1d60ff', 'rank', 'Rank', 'date', chart );
                chart.data = tempData;
            }

        /**
         * Product Star Rating Drawing
         * **/

            json = $('#product_star_rating').data('info');
              

                var avarageArray = json.filter((obj) => { if (obj.average != 0) return obj } )
                    .map((obj) => { return obj.average} );

                var starsObjectsArray = json.filter((obj) => { if (obj.stars.length > 0 ) return obj } )
                    .map((obj) =>  { return obj.stars } );
                var starsSummArray = {
                    "1": 0,
                    "2": 0,
                    "3": 0,
                    "4": 0,
                    "5": 0,
                };
                /* avarage rating */
                var avarageNumbersSum = 0;
                for(var i in avarageArray) {
                    avarageNumbersSum += avarageArray[i];
                }
                var avarageRating = (avarageNumbersSum / avarageArray.length).toFixed(2);
                for (var i = 0; i <= Math.floor(avarageRating); i++) {
                    $(parentSelectorId + ' .main-star-rating .rate-star:nth-child(' + i +')').addClass('full');
                }
                $(parentSelectorId + ' .main-star-rating .rate-star:nth-child(' + Math.ceil(avarageRating) +')').addClass('half');

                starsObjectsArray.forEach(stars => {
                    stars.forEach(star => {
                        starsSummArray[star["star"]] +=  star["deviation"];
                    })
                })

                var chartData1 = [], chartData2 = [], negative = 0, neutral = 0, positive = 0;
                for (var i in starsSummArray) {
                    starsSummArray[i] = starsSummArray[i] / starsObjectsArray.length;
                    $(parentSelectorId + ' .stars-column li[data-stars=' +i+'] .star-rating__value').text(starsSummArray[i].toFixed(1) + '%');
                    chartData2.push({category: i +' Star', value : starsSummArray[i].toFixed(1)})
                    if ( i < 3 ) {
                        negative += parseFloat(starsSummArray[i].toFixed(1));
                    } else if ( i == 3 ) {
                        neutral += parseFloat(starsSummArray[i].toFixed(1));
                    } else {
                        positive += parseFloat(starsSummArray[i].toFixed(1));
                    }
                }
                chartData1  = [
                    {category: 'Negative', value : negative},
                    {category: 'Neutral', value : neutral},
                    {category: 'Positive', value : positive}
                ];
                // var chartData2 = [{category: '1 Star', value : 40}, {category: '2 Stars', value : 20},
                //     {category: '3 Stars', value : 20}, {category: '4 Stars', value : 20}, {category: '5 Stars', value : 20}];

                let starRatingChange      = (json[json.length - 1].average - json[json.length - 2].average).toFixed(1);
                let starRatingChangeClass = starRatingChange > 0 ? 'up mark__gr' : 'down mark__red';

                $(parentSelectorId + ' span[data-id="starRatingChange"]').text( starRatingChange );
                $(parentSelectorId + ' span[data-id="starRatingChange"]').addClass( starRatingChangeClass );


                // $(parentSelectorId + ' p[data-id="productStarRating"]').html(avarageRating)
                startRatingPieShart(parentSelectorId + " #chartdiv", chartData1, chartData2);

        /** END PRODUCT STAR RATING DRAWING **/

        /**
         * Product Reviews Drawing
         * **/
  
        json = $('#product_monthly_reviews').data('info');
                var totalReviews       = 0;
                var totalReviewsRise   = 0;
                var changeVolumeClass  = '';
                var deviations = {
                    "negative": 0,
                    "neutral": 0,
                    "positive": 0,
                };

                json.forEach(month => {
                    totalReviews += month["volume"];
                    if ( month["sentiments"]!== undefined ) {
                        if (month["sentiments"]["negative"] !== undefined)
                            deviations["negative"] += month["sentiments"]["negative"] * 100;
                        if (month["sentiments"]["neutral"] !== undefined)
                            deviations["neutral"] += month["sentiments"]["neutral"] * 100;
                        if (month["sentiments"]["positive"] !== undefined)
                            deviations["positive"] += month["sentiments"]["positive"] * 100;
                    }
                })
                var lineChart = $(parentSelectorId + ' div[data-id="ratingDistribution"]');
                lineChart.find('.lp__red').css('width', deviations["negative"] / json.length + '%' );
                lineChart.find('.lp__gray').css('width', deviations["neutral"] / json.length + '%');
                lineChart.find('.lp__green').css('width', deviations["positive"] / json.length + '%');

                totalReviewsRise = json[json.length - 1]["volume"] - json[json.length - 2]["volume"];
                changeVolumeClass = totalReviewsRise > 0 ? 'up mark__gr' : 'down mark__red';

                totalReviewsRise = Math.abs( totalReviewsRise );

                $(parentSelectorId + ' p[data-id="reviews"]').text( totalReviews );
                $(parentSelectorId + ' span[data-id="reviewsRise"]').text( totalReviewsRise );
                $(parentSelectorId + ' span[data-id="reviewsRise"]').addClass( changeVolumeClass );

                currentProduct["volume"] = totalReviews;
                currentProduct["tooltip"]["list"]["volume"] = totalReviews;

                am4core.addLicense('CH211379993');
                am4core.useTheme(am4themes_animated);

                 chart = am4core.create((document.querySelector(parentSelectorId + ' #satisfaction')), am4charts.XYChart);
                 tempData = [];
                gengraph(chart, 'date');

                let satisfactionSum = 0;
                if (json){
                    json.forEach(item => {
                        if ( item.sentiments.positive!== undefined ) {
                            let satisfaction = (item.sentiments.positive * 100).toFixed(2);
                            satisfactionSum += item.sentiments.positive * 100;
                            console.log(satisfaction);
                            tempData.push(JSON.parse(`{ "satisfaction": ${satisfaction},"date": "${item.month}","month": "${convertDate(item.month)}"}`));
                        }
                    });

                    let avarageSatisfaction     = ( satisfactionSum / json.length ).toFixed(1);
                    let satisfactionChange      = (json[0].sentiments.positive * 100 - json[1].sentiments.positive * 100).toFixed(1);
                    let satisfactionChangeClass = satisfactionChange > 0 ? 'up mark__gr' : 'down mark__red';

                    $(parentSelectorId + ' p[data-id="satisfactionScore"]').text(avarageSatisfaction + '%');
                    $(parentSelectorId + ' span[data-id="satisfactionChange"]').text( satisfactionChange + '%' );
                    $(parentSelectorId + ' span[data-id="satisfactionChange"]').addClass( satisfactionChangeClass );
                    currentProduct["sentiment"] = parseFloat( avarageSatisfaction );
                    currentProduct["tooltip"]["list"]["sentiment"] = parseFloat( avarageSatisfaction );
                    create_line('#1d60ff', 'satisfaction', 'Satisfaction', 'date', chart );
                    chart.data = tempData;
                }
           

        /**
         * Product verified buyers
         * **/
        // $.ajax({
        //     url: myajax.url,
        //     type: 'POST',
        //     data: {
        //         action: 'get_monthly_verified_buyers',
        //         product_id: productGuid,
        //     },
        //     success: function (response) {
        //         let json = JSON.parse(response);
        //         var totalReviewers     = 0;
        //         var totalReviewersRise = 0;
        //         var changeVolumeClass  = '';
        //         json.forEach(month => {
        //             totalReviewers += month["volume"];
        //         })
        //         totalReviewersRise = json[0]["volume"] - json[1]["volume"];
        //         changeVolumeClass = totalReviewersRise > 0 ? 'up mark__gr' : 'down mark__red';
        //         totalReviewersRise = Math.abs( totalReviewersRise );
        //         $(parentSelectorId + ' p[data-id="reviewers"]').text( totalReviewers );
        //         $(parentSelectorId + ' span[data-id="reviewersRise"]').text( totalReviewersRise );
        //         $(parentSelectorId + ' span[data-id="reviewersRise"]').addClass( changeVolumeClass );
        //     }
        // });

        return currentProduct;
    }
    function drawCompetitors(parentSelectorId, productGuid, urlParams, currentProduct) {
        am4core.addLicense('CH211379993');
        let scatteredGraphArray           = [];
        scatteredGraphArray.push(currentProduct);

        /**
         * competitive products drawing
         * **/

         
        // $.ajax({
        //     url: myajax.url,
        //     type: 'POST',
        //     data: {
        //         action: 'get_competitive_products',
        //         product_id: productGuid,
        //     },
        //     success: function (competitive) {
        //         var data = JSON.parse(competitive);
        //         var uniqueCompetitors = [];
        //         data.forEach(item => {uniqueCompetitors.push(...item.uuids)})
        //         uniqueCompetitors = uniqueCompetitors.filter((v, i, a) => a.indexOf(v) === i).slice(0, 10);

        //         uniqueCompetitors.forEach(competitor => {
        //             $.ajax({
        //                 url: myajax.url,
        //                 type: 'POST',
        //                 data: {
        //                     action: 'get_product_data',
        //                     product_id: competitor,
        //                 },
        //                 success: function (response) {
        //                     var data = JSON.parse(response);

        //                     var competotorHtmlLine = `
        //                         <tr class="tr">
        //                             <td class="td__col td__prod">
        //                               <div class="t_flbox"><img src="${data["image"]}" alt="product"> <span>${data["name"]}</span></div>
        //                             </td>`;


        //                     $.ajax({
        //                         url: myajax.url,
        //                         type: 'POST',
        //                         data: {
        //                             action: 'get_monthly_reviews',
        //                             product_id: competitor,
        //                         },
        //                         success: function (response) {
        //                             response = JSON.parse(response);
        //                             var totalReviews     = 0;
        //                             var deviations = {
        //                                 "negative": 0,
        //                                 "neutral": 0,
        //                                 "positive": 0,
        //                             };

        //                             response.forEach(month => {
        //                                 totalReviews += month["volume"];
        //                                 if ( month["sentiments"]["negative"] !== undefined )
        //                                     deviations["negative"] += month["sentiments"]["negative"] * 100;
        //                                 if ( month["sentiments"]["neutral"] !== undefined )
        //                                     deviations["neutral"]  += month["sentiments"]["neutral"] * 100;
        //                                 if ( month["sentiments"]["positive"] !== undefined )
        //                                     deviations["positive"] += month["sentiments"]["positive"] * 100;
        //                             });

        //                             let satisfaction =  (deviations["positive"] / response.length).toFixed(2);
        //                             competotorHtmlLine += `<td class="td__col">234</td>
        //                                 <td class="td__col">${ totalReviews }</td>
        //                                 <td class="td__col">${ satisfaction }</td>
        //                                 <td class="td__col td__last">`;

        //                             competotorHtmlLine += `<div class="line_progress">
        //                                                         <div class="lp lp__red" style="width: ${ deviations["negative"] / response.length + '%' }"></div>
        //                                                         <div class="lp lp__gray" style="width: ${ deviations["neutral"] / response.length + '%' }"></div>
        //                                                         <div class="lp lp__green" style="width: ${ deviations["positive"] / response.length + '%' }"></div>
        //                                                         </div>
                                                            
        //                                                     </td>`;
        //                             competotorHtmlLine += '</tr>'

        //                             $(parentSelectorId + ' tbody[data-id="competitiveProducts"]').append(competotorHtmlLine);

        //                             scatteredGraphArray.push(JSON.parse(`
        //                                 { "sentiment": ${satisfaction},
        //                                   "volume": ${totalReviews},
        //                                   "uuid": "${competitor}",
        //                                   "tooltip": {
        //                                     "name" : "${data["name"]}",
        //                                     "list" : { "sentiment": "${satisfaction}%", "volume": ${totalReviews} }
        //                                   }
        //                                 }`));
        //                         },
        //                         complete: function() {

        //                             let volumeArray = scatteredGraphArray.map(obj => {return obj});
        //                             if (scatteredGraphArray.length >= 5) {
        //                                 scatteredGraph(parentSelectorId + ' #scatteredGraph', scatteredGraphArray, Math.max(...volumeArray),  productGuid);
        //                             }
        //                             console.log(scatteredGraphArray)
        //                             console.log( Math.max(...volumeArray))
        //                             console.log( productGuid)
        //                         }
        //                     });
        //                 },
        //                 error: function () {
        //                     console.log("Error");
        //                 }
        //             });
        //         })

        //     },
        //     error: function () {
        //         console.log("Error");
        //     },
        // });


var sccc= [];
scatteredGraph(parentSelectorId + ' #scatteredGraph', sccc, null,  productGuid);
        /** END COMPETITIVE DRAWING **/

    }
    function drawMegatopicSentiment(parentSelectorId, productGuid, urlParams) {
        am4core.addLicense('CH211379993');
        /**
         * Mega Topic Monthly Sentiment
         * **/
        let brandEquity = [];
        let valueForMoney = [];
        let productQuality = [];
        let shoppingExperience = [];
        let overallSatisfaction = [];
        let fullData = [];

                let json = JSON.parse($('#product_topic_monthly_sentiment').val());

                json.forEach( (month, index) => {
                    let overallValue = 0;
                    let monthTemp    = convertDate( month.month );

                    fullData.push(JSON.parse(`{ "date": "${month.month}","month": "${monthTemp}"}`));

                    month.megaTopics.forEach( mark => {
                        let sentiment = mark.sentiment * 100;
                        if (mark.name === 'Brand Equity') {
                            brandEquity.push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${monthTemp}"}`));
                            fullData[index]["brandEquity"] = sentiment;
                            overallValue += sentiment;
                        } else if (mark.name === 'Value for Money') {
                            valueForMoney.push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${monthTemp}"}`));
                            fullData[index]["valueForMoney"] = sentiment;
                            overallValue += sentiment;
                        } else if (mark.name === 'Product Quality') {
                            productQuality.push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${monthTemp}"}`));
                            fullData[index]["productQuality"] = sentiment;
                            overallValue += sentiment;
                        } else if (mark.name === 'Shopping Experience') {
                            shoppingExperience.push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${monthTemp}"}`));
                            fullData[index]["shoppingExperience"] = sentiment;
                            overallValue += sentiment;
                        }
                    });

                    if(month.megaTopics.length!=0  ) {
                        overallValue = overallValue / month.megaTopics.length;

                        fullData[index]["overall"] = overallValue;
                        overallSatisfaction.push(JSON.parse(`{ "sentiment": ${overallValue},"date": "${monthTemp}"}`));
                    }
                })


                $(parentSelectorId + ' div[data-id="overallSatisfactionStat"]').text( getAvarage(overallSatisfaction, "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="brandEquityStat"]').text( getAvarage(brandEquity, "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="valueForMoneyStat"]').text( getAvarage(valueForMoney, "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="productQualityStat"]').text( getAvarage(productQuality, "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="shoppingExperienceStat"]').text( getAvarage(shoppingExperience, "sentiment")  + '%');

                overtimeTopicGraph(parentSelectorId + ' #overallSatisfaction',  overallSatisfaction, 1, '#ff8802');
                overtimeTopicGraph(parentSelectorId + ' #brandEquity',  brandEquity, 1, '#1d60ff');
                overtimeTopicGraph(parentSelectorId + ' #valueForMoney',  valueForMoney, 1, '#55a73f');
                overtimeTopicGraph(parentSelectorId + ' #productQuality',  productQuality, 1, '#6256aa');
                overtimeTopicGraph(parentSelectorId + ' #shoppingExperience',  shoppingExperience, 1, '#ff4181');


                var chart2 = am4core.create((document.querySelector(parentSelectorId + ' #satisfactionOverTime')), am4charts.XYChart);
                gengraph(chart2, 'date');
                create_line('#ff8802', 'overall', 'Overall Satisfaction', 'date', chart2 );
                create_line('#1d60ff', 'brandEquity', 'Brand Equity', 'date', chart2 );
                create_line('#55a73f', 'valueForMoney', 'Value For Money', 'date', chart2 );
                create_line('#6256aa', 'productQuality', 'Product Quality', 'date', chart2 );
                create_line('#ff4181', 'shoppingExperience', 'Shopping Experience', 'date', chart2 );

                chart2.data = fullData;
                // console.log(fullData);

                $(parentSelectorId + ' .chart__blurb-wrap').click(function(e) {
                    let id     = parseInt( $(this).attr('data-seties-id') );
                    let series = chart2.series.getIndex(id);
                    $(this).toggleClass('inactive');
                    if (series.isHiding || series.isHidden) {
                        series.show();
                    } else {
                        series.hide();
                    }
                })

    }
    function drawMegatopicSentimentCompare(parentSelectorId, productGuid1, productGuid2, urlParams) {
        am4core.addLicense('CH211379993');
        /**
         * Mega Topic Monthly Sentiment
         * **/
        let brandEquity = [[], []];
        let valueForMoney = [[], []];
        let productQuality = [[], []];
        let shoppingExperience = [[], []];
        let overallSatisfaction = [[], []];
        let fullData = [];

        $.ajax({
            url: myajax.url,
            type: 'POST',
            data: {
                action: 'get_topic_monthly_sentiment_compare',
                product_id: productGuid1,
                product_id_2: productGuid2,
            },
            success: function (response) {
                let json = JSON.parse(response);
                let response1 = JSON.parse(json.response_1);
                let response2 = JSON.parse(json.response_2);

                let response3 = JSON.parse(json.response_2);
                response3.forEach((obj) => {
                    Object.defineProperty(obj, 'megaTopics2',
                        Object.getOwnPropertyDescriptor(obj, 'megaTopics'));
                    delete obj["megaTopics"];
                })

                response3.forEach((month) => {

                    let newElement = response1.find( bitem => month["month"] === bitem["month"]);
                    if (newElement !== undefined) {
                        month["megaTopics"] = newElement;
                    }
                })
                let reducedArray =  response1.filter( aitem => ! response3.find ( bitem => aitem["month"] === bitem["month"]) );

                response3.forEach( (month, index) => {
                    let overallValue = 0;
                    let monthTemp    = convertDate( month.month );

                    fullData.push(JSON.parse(`{ "date": "${month.month}","month": "${monthTemp}"}`));

                    if (month.megaTopics !== undefined)  {

                        month.megaTopics.megaTopics.forEach( mark => {
                            let sentiment = mark.sentiment * 100;
                            if (mark.name === 'Brand Equity') {
                                brandEquity[0].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                                fullData[index]["brandEquity"] = sentiment;
                                overallValue += sentiment;
                            } else if (mark.name === 'Value for Money') {
                                valueForMoney[0].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                                fullData[index]["valueForMoney"] = sentiment;
                                overallValue += sentiment;
                            } else if (mark.name === 'Product Quality') {
                                productQuality[0].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                                fullData[index]["productQuality"] = sentiment;
                                overallValue += sentiment;
                            } else if (mark.name === 'Shopping Experience') {
                                shoppingExperience[0].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                                fullData[index]["shoppingExperience"] = sentiment;
                                overallValue += sentiment;
                            }
                        });

                        overallValue = overallValue / month.megaTopics.megaTopics.length;
                        fullData[index]["overall"] = overallValue;
                        overallSatisfaction[0].push(JSON.parse(`{ "sentiment": ${overallValue},"date": "${month.month}","month": "${monthTemp}"}`))
                    }

                    let overallValue2 = 0;
                    month.megaTopics2.forEach( mark => {
                        let sentiment = mark.sentiment * 100;
                        if (mark.name === 'Brand Equity') {
                            brandEquity[1].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                            fullData[index]["brandEquity2"] = sentiment;
                            overallValue2 += sentiment;
                        } else if (mark.name === 'Value for Money') {
                            valueForMoney[1].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                            fullData[index]["valueForMoney2"] = sentiment;
                            overallValue2 += sentiment;
                        } else if (mark.name === 'Product Quality') {
                            productQuality[1].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                            fullData[index]["productQuality2"] = sentiment;
                            overallValue2 += sentiment;
                        } else if (mark.name === 'Shopping Experience') {
                            shoppingExperience[1].push(JSON.parse(`{ "sentiment": ${sentiment},"date": "${month.month}","month": "${monthTemp}"}`));
                            fullData[index]["shoppingExperience2"] = sentiment;
                            overallValue2 += sentiment;
                        }
                    });

                    overallValue2 = overallValue2 / month.megaTopics2.length;
                    fullData[index]["overall2"] = overallValue2;
                    overallSatisfaction[1].push(JSON.parse(`{ "sentiment": ${overallValue2},"date": "${month.month}","month": "${monthTemp}"}`))
                })

                $(parentSelectorId + ' div[data-id="overallSatisfactionStat"]').text( getAvarage(overallSatisfaction[0], "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="brandEquityStat"]').text( getAvarage(brandEquity[0], "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="valueForMoneyStat"]').text( getAvarage(valueForMoney[0], "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="productQualityStat"]').text( getAvarage(productQuality[0], "sentiment")  + '%');
                $(parentSelectorId + ' div[data-id="shoppingExperienceStat"]').text( getAvarage(shoppingExperience[0], "sentiment")  + '%');

                overtimeTopicGraph(parentSelectorId + ' #overallSatisfaction',  overallSatisfaction[0], 1, '#ff8802', overallSatisfaction[1]);
                overtimeTopicGraph(parentSelectorId + ' #brandEquity',  brandEquity[0], 1, '#1d60ff', brandEquity[1]);
                overtimeTopicGraph(parentSelectorId + ' #valueForMoney',  valueForMoney[0], 1, '#55a73f', valueForMoney[1]);
                overtimeTopicGraph(parentSelectorId + ' #productQuality',  productQuality[0], 1, '#6256aa', productQuality[1]);
                overtimeTopicGraph(parentSelectorId + ' #shoppingExperience',  shoppingExperience[0], 1, '#ff4181', shoppingExperience[1]);

                var chart2 = am4core.create((document.querySelector(parentSelectorId + ' #satisfactionOverTime')), am4charts.XYChart);
                gengraph(chart2, 'date');
                create_line('#1D60FF', 'overall', 'Overall Satisfaction', 'date', chart2 );
                create_line('#1D60FF', 'brandEquity', 'Brand Equity', 'date', chart2 );
                create_line('#1D60FF', 'valueForMoney', 'Value For Money', 'date', chart2 );
                create_line('#1D60FF', 'productQuality', 'Product Quality', 'date', chart2 );
                create_line('#1D60FF', 'shoppingExperience', 'Shopping Experience', 'date', chart2 );

                create_line('#AB00C7', 'overall2', 'Overall Satisfaction', 'date', chart2 );
                create_line('#AB00C7', 'brandEquity2', 'Brand Equity', 'date', chart2 );
                create_line('#AB00C7', 'valueForMoney2', 'Value For Money', 'date', chart2 );
                create_line('#AB00C7', 'productQuality2', 'Product Quality', 'date', chart2 );
                create_line('#AB00C7', 'shoppingExperience2', 'Shopping Experience', 'date', chart2 );
                //
                chart2.data = fullData;

                $(parentSelectorId + ' .chart__blurb-wrap').click(function(e) {
                    let id     = parseInt( $(this).attr('data-seties-id') );
                    $(parentSelectorId + ' .chart__blurb-wrap').addClass('inactive');
                    $(this).removeClass('inactive');

                    for (let i = 0; i < 5; i++) {
                        let series = chart2.series.getIndex(i);
                        let series2 = chart2.series.getIndex(i+5);

                        if (i !== id) {
                            series.hide();
                            series2.hide();
                        } else {
                            if (series2.isHiding || series2.isHidden) {
                                series2.show();
                            }
                            if (series.isHiding || series.isHidden) {
                                series.show();
                            }
                        }
                    }
                })

                setTimeout(function() {
                    $(parentSelectorId + ' .chart__blurb-wrap').addClass('inactive');
                    $(parentSelectorId + ' .chart__blurb:first-child .chart__blurb-wrap').trigger('click');
                    console.log('timeout passed')
                },2000);
            },
            complete: function() {
                console.log('complete');
            }
        });

    }

    $(document).ready(function() {
        var url       = new URL(window.location);
        var urlParams = new URLSearchParams(url.search);
        let currentProduct                    = {};
            currentProduct["tooltip"]         = {};
            currentProduct["tooltip"]["list"] = {};

        $('.navigation a').click(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let target = $(this).attr('href');
            $('html,body').animate({scrollTop: $(target).offset().top - $('.navbar').height()},'');
        })

        // if (urlParams.has('productGuid')) {
            // if ($('#singleProduct').length > 0) {
                currentProduct = drawOverview('#singleProduct #overview', '', urlParams, currentProduct);
                drawCompetitors('#singleProduct #competitive_landscape', jQuery('#competitive_landscape').data('id'), urlParams, currentProduct);
                drawMegatopicSentiment('#singleProduct #product_satisfaction', '', urlParams);
            // }
        // }

        // if (urlParams.has('productGuid1')) {
        //     if ($('#overview #productOverview1').length > 0) {
                // currentProduct = drawOverview('#overview #productOverview1', urlParams.get('productGuid1'), urlParams, currentProduct);
        //     }
        // }

        // if (urlParams.has('productGuid2')) {
        //     if ($('#overview #productOverview2').length > 0) {
        //         currentProduct = drawOverview('#overview #productOverview2', urlParams.get('productGuid2'), urlParams, currentProduct);
        //         drawMegatopicSentimentCompare('#product_satisfaction', urlParams.get('productGuid1'),urlParams.get('productGuid2'), urlParams);

        //     }
        // }

        $('.js-share-sidebar').click(function(e) {
            e.preventDefault();
            $('.share-report__vertical').toggleClass('active');
        })
    });
})(window.jQuery)





















