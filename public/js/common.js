'use strict';

let metatags = document.getElementsByTagName('meta');
let category, subclass;
for (let i = 0; i < metatags.length; i++){
    if (metatags[i].getAttribute('name') === 'category'){
        category = metatags[i].getAttribute('content');
    }
    if (metatags[i].getAttribute('name') === 'subclass'){
        subclass = metatags[i].getAttribute('content');
    }
}
let active_top = document.getElementById('practise_li');
let active_category = document.getElementById(category+'_li');
let active_subclass = document.getElementById(subclass+'_li');
active_top === null ? '' : active_top.classList.add('active');
active_category === null ? '' : active_category.classList.add('active');
active_subclass === null ? '' : active_subclass.classList.add('active');