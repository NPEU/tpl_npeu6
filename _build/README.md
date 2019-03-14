NPEU6 Build Scripts
===================

The NPEU6 template is designed to allow a Super Admin to compile the production files (e.g. CSS and JS) directly from the Joomla admin interface without the need to have all the build stuff installed locally.

This also allows PHP to trigger a build process in response to events such as new Brand Project data becomeing available.
(Brand Projects are a sister component to the this template).

Notes
-----

To manually execute Bower update you need to have PHP installed and run:

`php vendor/beelab/bowerphp/bin/bowerphp install` from this directtory.

Note that the intention is that this is not run locally, but by the templates build process, but it's useful to know how things work manually.