/**
 * Created by Евгения on 15.12.2016.
 */
function initRanges(idRange) {
    var Slider = document.getElementById(idRange);
    noUiSlider.create(Slider, {
        start: 50,
        connect: [true, false],
        range: {
            'min': 0,
            'max': 100
        },
        format: wNumb({
            decimals: 1,
            thousand: '.',
            postfix: '%',
        }),
    });
    Slider.noUiSlider.on('update', function(){
        var sliderValue = document.getElementById('value_' + idRange);
        var viewValue = document.getElementById('view_range_val_' + idRange);
        sliderValue.value = Slider.noUiSlider.get();
        viewValue.innerHTML = Slider.noUiSlider.get();
    });
}
