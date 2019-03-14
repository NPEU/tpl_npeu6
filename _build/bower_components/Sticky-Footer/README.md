Sticky-Footer
===========

Not so much a 'Fall-Back' but a useful sticky-footer pattern with good browser support.

[Demo](http://lab.gridlight-design.co.uk/fallback/sticky-footer/sticky-footer-basic.html)

HTML:
~~~~~~~~
<body>
    <div class="sticky-footer-wrap">
    
    ...
    
        <footer class="sticky-footer">
            ...
        </footer>
    </div>
</body>
~~~~~~~~

If you need the `.sticky-footer-wrap` container be a nested more deeply, it's parent/wrapper elements should include the class `.sticky-footer-outer-wrap` _unlesss_ the those wrappers already have `height: 100%;` CSS applied:

HTML:
~~~~~~~~
<body>
    <div class="sticky-footer-outer-wrap">
        <div class="sticky-footer-wrap">
        
        ...
        
            <footer class="sticky-footer">
                ...
            </footer>
        </div>
    </div>
</body>