Search-Form
===========

Simple pattern for an expanding search form.

[Demo](http://lab.gridlight-design.co.uk/fallback/search-form.html)


Basic Markup Example
--------------------

```
<form action="#search" id="searchform" class="search-form" method="GET">
    <input type="search" class="search-form__field" id="search" placeholder="Search" name="s" value="" aria-label="Search" />
    <button class="search-form__submit" type="submit">
        <span>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20">
                <path fill="#333333" d="M12.917 11.667h-0.662l-0.229-0.229c0.817-0.946 1.308-2.175 1.308-3.521 0-2.992-2.425-5.417-5.417-5.417s-5.417 2.425-5.417 5.417 2.425 5.417 5.417 5.417c1.346 0 2.575-0.492 3.521-1.304l0.229 0.229v0.658l4.167 4.158 1.242-1.242-4.158-4.167zM7.917 11.667c-2.071 0-3.75-1.679-3.75-3.75s1.679-3.75 3.75-3.75 3.75 1.679 3.75 3.75-1.679 3.75-3.75 3.75z"></path>
                <text y="-1">Search</text>
            </svg>
        </span>
    </button>
</form>
```

Expanding Example
-----------------

```
<form action="#search" id="searchform" class="search-form" method="GET">
    <input type="search" class="search-form__field" id="search" placeholder="Search" name="s" value="" aria-label="Search" />
    <button class="search-form__submit" type="submit">
        <span>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20">
                <path fill="#333333" d="M12.917 11.667h-0.662l-0.229-0.229c0.817-0.946 1.308-2.175 1.308-3.521 0-2.992-2.425-5.417-5.417-5.417s-5.417 2.425-5.417 5.417 2.425 5.417 5.417 5.417c1.346 0 2.575-0.492 3.521-1.304l0.229 0.229v0.658l4.167 4.158 1.242-1.242-4.158-4.167zM7.917 11.667c-2.071 0-3.75-1.679-3.75-3.75s1.679-3.75 3.75-3.75 3.75 1.679 3.75 3.75-1.679 3.75-3.75 3.75z"></path>
                <text y="-1">Search</text>
            </svg>
        </span>
    </button>
    <a href="#" tabindex="-1" class="search-form__cancel  icon-wrap  js-no-history"><svg width="0" height="0" class="icon"><use xlink:href="#icon-cross"></use></svg></a>
    <ul class="search-form__adjacent">
        <li>
            <a href="#">A Link</a>
        </li>
        <li>
            <a href="#">Another Link</a>
        </li>
    </ul>
</form>
```

Notes / explanation
-------------------

**1. The search submit button**

The **search submit icon** is inline SVG in order to provide the best possible fallbacks.
Create your icon as you normally would *without* the fallback text, making sure to include `width`, `height` and `viewbox` as in the above examples.
Then paste the SVG markup inside the button's `span` and *manually* add the fallback `text` tag. Note the `y="-1"` is important to help fully hide the text in some browsers.
The way this works is that if SVG isn't supported, the text will show instead and the button's width will adapt accordingly. However in browsers that support don't support SVG but do support data-uri's, a PNG fallback can be shown instead.
You'll need to create a PNG version of your SVG icon, and then base64 encode it.

Example online tools:

[SVG to PNG converter](http://image.online-convert.com/convert-to-png)
[Base64 encoder](https://www.base64decode.org/)


**2. The cancel button**

If the expanding pattern is used, when the search field is focussed, a cancel button will appear. This may seem a little unusual, but it's useful for UI purposes.
On some some touch devices, it's not always obvious how to dismiss the keyboard (and therefore blur the search field) so the cancel button helps to provide an obvious way to cancel typing.
Even on desktop browsers some users may not realised they need to 'click off' the search field to make it collapse again, so this button helps there too.

**3. The collapsing section**

Collapsing section section can be any sibling container with a class of `.search-form__collapse`.
The main use-case for this would be for the container to contain navigation links (see combining with Nav Bar), but they could be anything.
It could be a user's name, a site logo for example.
