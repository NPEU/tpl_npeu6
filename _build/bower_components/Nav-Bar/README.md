Navbar
======

A responsive CSS only navigation bar that degrades well in older browser and provides a single-tier dropdown option. 

Markup Example
--------------

```
<div class="nav-bar">
    <nav class="nav-bar__inner">          
        <ul class="nav-bar__items">
            <li class="nav-bar__item  has-subnav">
                <a href="#" class="nav-bar__link">About us</a>
                <a href="#about-us-submenu" class="nav-bar__link  subnav__open   subnav__open--icon-only  js-no-history" hidden><svg width="0" height="0" class="icon  icon--narrow" aria-label="About Us Submenu"><use xlink:href="#icon-triangle-down"></use></svg></a>
                <ul class="subnav" id="about-us-submenu">
                    <li class="subnav__item"><a href="#" class="subnav__link">What we do</a></li>
                    <li class="subnav__item"><a href="#" class="subnav__link">Contact us</a></li>
                    <li class="subnav__item"><a href="#" class="subnav__link">Meet the team</a></li>
                    <li class="subnav__item"><a href="#" class="subnav__link">Testimonials</a></li>
                </ul>
                <a href="#" class="subnav__link  subnav__cancel  js-no-history" hidden><svg width="0" height="0" class="icon" aria-label="Close submenu"><use xlink:href="#icon-cross"></use></svg></a>
            </li>
            <li class="nav-bar__item"><a href="#3" class="nav-bar__link">News</a></li>
            <li class="nav-bar__item  has-subnav">
                <span class="subnav__heading">Categories:</span>
                <a href="#categories-submenu" data-content="Categories:" class="nav-bar__link  subnav__open  js-no-history" aria-label="Categories Submenu" hidden> <svg width="0" height="0" class="icon  icon--narrow"><use xlink:href="#icon-triangle-down"></use></svg></a>
                <ul class="subnav" id="categories-submenu">
                    <li class="subnav__item"><a href="#" class="subnav__link">Category 1</a></li>
                    <li class="subnav__item"><a href="#" class="subnav__link">Category 2</a></li>
                    <li class="subnav__item"><a href="#" class="subnav__link">Category 3</a></li>
                </ul>
                <a href="#" class="subnav__link  subnav__cancel  js-no-history" hidden><svg width="0" height="0" class="icon" aria-label="Close submenu"><use xlink:href="#icon-cross"></use></svg></a>
            </li>
        </ul>
    </nav>
</div>
```
