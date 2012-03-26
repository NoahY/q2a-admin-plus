=================================
Question2Answer Admin Plus
=================================
-----------
Description
-----------
This is a plugin for **Question2Answer** that extends the admin area.

--------
Features
--------
- turns admin submenu into drop-down
- execute php commands from plugin page (option to require password, see `Password`_ below)
- adds "top" links to each plugin in admin
- adds "r" buttons to reset values of plugin options
- shows notice to admin if updates for plugins are available
- allows emails to be sent to admin for answer and comment posts.

------------
Installation
------------
#. Install Question2Answer_
#. Get the source code for this plugin from github_, either using git_, or downloading directly:

   - To download using git, install git and then type 
     ``git clone git://github.com/NoahY/q2a-admin-plus.git admin``
     at the command prompt (on Linux, Windows is a bit different)
   - To download directly, go to the `project page`_ and click **Download**

#. extract the files to a subfolder such as ``admin`` inside the ``qa-plugins`` folder of your Q2A installation.
#. navigate to your site, go to **Admin -> Plugins** on your q2a install and select options, then click **Save Changes**.

.. _Question2Answer: http://www.question2answer.org/install.php
.. _git: http://git-scm.com/
.. _github:
.. _project page: https://github.com/NoahY/q2a-admin-plus

----------
Password
----------
.. _Password:
Given the security risk involved with allowing arbitrary PHP code execution, it is recommended to require a password in order to use this function.  Add a file named `password` to the plugin directory, and put the password as the file's only content.  The plugin will recognize this, and add a field to enter it when executing code.

----------
Disclaimer
----------
This is **beta** code.  It is probably okay for production environments, but may not work exactly as expected.  Refunds will not be given.  If it breaks, you get to keep both parts.

-------
Release
-------
All code herein is Copylefted_.

.. _Copylefted: http://en.wikipedia.org/wiki/Copyleft

---------
About q2A
---------
Question2Answer is a free and open source platform for Q&A sites. For more information, visit:

http://www.question2answer.org/

