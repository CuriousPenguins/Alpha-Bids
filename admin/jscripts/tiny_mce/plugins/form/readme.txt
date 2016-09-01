Author: Todd Stewart
url:    stew.org
email:  tinymceform@stew.org

------------------------------------------------------------

Plugin Name: Form

------------------------------------------------------------
Description:
        This plugin is desgined for installation and intergration with the Tiny MCE
editor interface. I have designed the buttons and taken influence from the functionality
of the exisiting table plugin.

Scenario:
        Allows creation and alteration of form elements.

------------------------------------------------------------

Install:
        Simply add the plugin to TinyMCE and place the /form dir within the plugins dir.
        TinyMCE must be configured to see the plugin.


Known Bugs:
        Mozilla and firefox seem to have difficulty specifying focus on an element, so changing an element's properties is tricky.
        I have been unable to make the "selected" parameter for options stick. It seems to be removed by some clean-up.
        