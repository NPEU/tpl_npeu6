NPEU6 Build Scripts
===================

The NPEU6 template is designed to allow a Super Admin to compile the production files (e.g. CSS and JS) directly from the Joomla admin interface without the need to have all the build stuff installed locally.

This also allows PHP to trigger a build process in response to events such as new Brand Project data becomeing available.
(Brand Projects are a sister component to the this template).

Notes
-----

To manually execute Bower update you need to have PHP installed and run:

`php vendor/beelab/bowerphp/bin/bowerphp install` from this directtory.

Note that the intention is that this is run locally - we want to develop the template, including usage of dependancies, in a safe environment with a Styleguide-first approach.

Once the SCSS etc is committed to the template via update, it's fine for the server to build the final CSS (indeed it has to), but it wouldn't be good introduce changes to the SCSS or dependancies in this way.