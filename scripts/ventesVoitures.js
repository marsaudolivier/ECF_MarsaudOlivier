var snapSlider = document.getElementById('slider-snap');

noUiSlider.create(snapSlider, {
    start: [0,22500],
    snap: true,
    connect: true,
    range: {
        'min': 0,
        '10%': 2500,
        '20%': 5000,
        '30%': 7500,
        '40%': 10000,
        '50%': 12500,
        '60%': 15000,
        '80%': 17500,
        '90%': 20000,
        'max': 22500
    }
});

var snapValues = [
    document.getElementById('slider-snap-value-lower'),
    document.getElementById('slider-snap-value-upper')
];

snapSlider.noUiSlider.on('update', function (values, handle) {
    snapValues[handle].innerHTML = values[handle] + '€';
});

var snapSliderTwo = document.getElementById('slider-snapTwo');

noUiSlider.create(snapSliderTwo, {
    start: [0,225000],
    snap: true,
    connect: true,
    range: {
        'min': 0,
        '10%': 25000,
        '20%': 50000,
        '30%': 75000,
        '40%': 100000,
        '50%': 125000,
        '60%': 150000,
        '80%': 175000,
        '90%': 200000,
        'max': 225000
    }
});

var snapValuesTwo = [
    document.getElementById('slider-snap-value-lowerTwo'),
    document.getElementById('slider-snap-value-upperTwo')
];
snapSliderTwo.noUiSlider.on('update', function (values, handle) {
    snapValuesTwo[handle].innerHTML = values[handle] + 'Km';
});

var snapSliderTrois = document.getElementById('slider-snapTrois');

noUiSlider.create(snapSliderTrois, {
    start: [1950,2024],
    snap: true,
    connect: true,
    step : 1,
    range: {
        'min': 1950,
        '10%': 1970,
        '20%': 1990,
        '30%': 2000,
        '40%': 2005,
        '50%': 2010,
        '55%': 2015,
        '60%': 2016,
        '65%': 2017,
        '70%': 2018,
        '75%': 2019,
        '80%': 2020,
        '85%': 2021,
        '90%': 2022,
        '95%': 2023,
        'max': 2024
    }
});

var snapValuesTrois = [
    document.getElementById('slider-snap-value-lowerTrois'),
    document.getElementById('slider-snap-value-upperTrois')
];
snapSliderTrois.noUiSlider.on('update', function (values, handle) {
    snapValuesTrois[handle].innerHTML = values[handle] ;
});

document.getElementById('reset_prix').addEventListener('click', function () {
    snapSlider.noUiSlider.reset();
});
document.getElementById('reset_km').addEventListener('click', function () {
    snapSliderTwo.noUiSlider.reset();
});
document.getElementById('reset_annee').addEventListener('click', function () {
    snapSliderTrois.noUiSlider.reset();
});