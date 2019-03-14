// Attempt at building a browser-info display tool:
window.onload = (function(onload) {
    return function(event) {
        onload && onload(event);

        var browser_info = {
            'User agent': navigator.userAgent,
            'Device pixel ratio': window.devicePixelRatio,
            'Viewport width': document.documentElement.clientWidth,
            'Viewport height': document.documentElement.clientHeight,
            'Device width': window.screen.availWidth,
            'Device height': window.screen.availHeight
        };

        var browser_info_table = document.getElementById('browser_info');
        var browser_info_body  = browser_info_table.tBodies[0];
        var row, cell1, cell2, i;
        browser_info_body.deleteRow(0);

        for (i in browser_info) {
            row   = browser_info_body.insertRow(-1);
            cell1 = row.insertCell(-1);
            cell1.innerHTML = i;
            cell2 = row.insertCell(-1);
            cell2.innerHTML = browser_info[i];
        }
    }
}(window.onload));

/*-- Test pages only: --------------------------------------------------------*/
/* Functions */
function ready(fn) {
    if (document.readyState != 'loading'){
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}

function hasClass(el, className) {
    if (el.classList) {
        var r = el.classList.contains(className);
    } else {
        var r = new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
    }
    return r;
}

function toggleClass(el, className) {
    if (el.classList) {
        el.classList.toggle(className);
    } else {
        var classes = el.className.split(' ');
        var existingIndex = classes.indexOf(className);

        if (existingIndex >= 0) {
            classes.splice(existingIndex, 1);
        } else {
            classes.push(className);
        }
        el.className = classes.join(' ');
    }
    
}

function preprend(parent, el) {
    parent.insertBefore(el, parent.firstChild);
}
/**/

/* Add toolbox: */
ready(function(){
    var $body = document.querySelectorAll('body')[0];
    var $main = document.querySelectorAll('main')[0];
    var toolbox = document.createElement('div');
    toolbox.id = 'toolbox';
    toolbox.className = 'tb-toolbox';
    var tools = [
        '<input type="checkbox" id="toggleBaseline"' + (hasClass($body, 'tb-baseline') ? ' checked' : '') + ' "> ',
        '<label for="toggleBaseline">Baseline grid</label><br>',
        '<input type="checkbox" id="toggleOutlines"' + (hasClass($body, 'tb-outlines') ? ' checked' : '') + ' "> ',
        '<label for="toggleOutlines">Outline elements</label><br>',
        '<label for="maxMainWidth">Max main width:</label><br>',
        '<input type="text" id="maxMainWidth" />',
    ];
    //toolbox.innerHtml = tools.join("\n");
    preprend($body, toolbox);
    var $toolbox = document.querySelectorAll('#toolbox')[0];
    $toolbox.innerHTML = tools.join("\n");
   
    var $toggleBaseline = document.querySelectorAll('#toggleBaseline')[0];
    var $toggleOutlines = document.querySelectorAll('#toggleOutlines')[0];
    var $maxMainWidth   = document.querySelectorAll('#maxMainWidth')[0];
    
    // Set default values:
    $maxMainWidth.value = getComputedStyle($main)['maxWidth'];
    
    // Add event handlers:
    $toggleBaseline.addEventListener('change', function(){
        toggleClass($body, 'tb-baseline');
    });
    
    $toggleOutlines.addEventListener('change', function(){
        toggleClass($body, 'tb-outlines');
    });
    
    $maxMainWidth.addEventListener('change', function(){
        $main.style.maxWidth = $maxMainWidth.value;
    });


    
   
    /*
    $("#toggleBaseline").change(function(){
        $("body").toggleClass('baseline-grid');
    });
    $("#toggleHeadingBg").change(function(){
        $("body").toggleClass('heading-background');
    });
    $("#toggleSectionBg").change(function(){
        $("body").toggleClass('section-background');
    });*/
});

/*
Add margins to 'off-grid' elements to maintain vertical rhythm.
Note we're assuming the only 'off-grid' elements -- `pre`, `img`, `video` -- will be contained
within `figure`s.
We also assume (know) that figures have a 1.5rem bottom margin, and we don't use top margins, so we
should be safe to _reduce_ the bottom margin by enough to restore grid alignment.
*//*
window.onload = (function(onload) {
    return function(event) {
        onload && onload(event);

        //var $root = document.querySelectorAll(':root')[0];
        var $body = document.querySelectorAll('body')[0];
        var $main   = document.querySelectorAll('main')[0];
        var figures = $main.querySelectorAll('figure');
        
        var grid_size = getComputedStyle($body)['line-height'];
        var grid_unit = parseInt(grid_size, 10) / 2;
        
        console.log(grid_size, grid_unit);
        
        figures.forEach(function(item, i){
            //console.log(item, (item.offsetHeight / grid_unit - Math.floor(item.offsetHeight / grid_unit)) );
            //var val = grid_unit + (grid_size * (item.offsetHeight / grid_unit - Math.floor(item.offsetHeight / grid_unit))) + 'rem';
            var diff = item.offsetHeight / grid_unit - (Math.floor(item.offsetHeight / grid_unit));
            console.log(diff);
            if (diff > 0) {
                var diff_px = (grid_unit * 2 - (grid_unit * diff));
                console.log(diff_px);
                item.style.marginBottom = diff_px + 'px';
            }
            
            
            //item.style.marginBottom = grid_unit + (grid_size * (item.offsetHeight / grid_unit - Math.floor(item.offsetHeight / grid_unit))) + 'rem';
        });
    }
}(window.onload));*/