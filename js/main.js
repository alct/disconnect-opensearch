var d = document;
var w = window;
var html = d.documentElement;

var anchor = location.hash.substring(1);

var opensearch = d.querySelectorAll('link[rel="search"]')[0].href;

var tabs = d.querySelectorAll('.nav li');
var instructions = d.querySelectorAll('.instructions');

var buttons = d.getElementsByClassName('add-button');

function toggleJS() {

    html.classList.remove('no-js');
    html.classList.add('js');
}

function toggleTab(tab) {

    // activate the proper tab

    [].forEach.call(tabs, function(el) {

        el.classList.remove('active');
    });

    tab.classList.add('active');

    // activate the related instructions

    [].forEach.call(instructions, function(el) {

        if (el.classList.contains(tab.classList[0])) {

            el.classList.add('active');

        } else {

            el.classList.remove('active');
        }
    });
}

function addSP(xml) {

    try {

        w.external.AddSearchProvider(xml);

    } catch (e) {

        alert('Your browser is not supported.');
        location.replace(location.href.split("#")[0] + '#others');
    }
}

d.addEventListener('DOMContentLoaded', function() {

    toggleJS();

    if (anchor) {

        toggleTab(d.querySelectorAll('.nav .' + anchor)[0]);
    }
});

w.addEventListener('hashchange', function() {

    var anchor = location.hash.substring(1);

    toggleTab(d.querySelectorAll('.nav .' + anchor)[0]);
});

[].forEach.call(tabs, function(el) {

    el.addEventListener('click', function(){

        toggleTab(el);
    });
});

[].forEach.call(buttons, function(el) {

    el.addEventListener('click', function() {

        addSP(opensearch);
    });
});
