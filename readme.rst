#####################
What is CSEDL Manager
#####################

CSEDL Manager is a library management software designed exclusively for the management of the department library of Computer Science and Engineering department of Malabar Institute of Technology, Anjarakandy. The purpose behind the creation of this software is to familiarize MVC programming using the amazing framework called CodeIgniter. This is developed as a time pass project by me and should be considered only at that level.

*******************
Release Information
*******************

The latest version of CSEDL Manager is v 1.8 release on 23-07-2015. The software is still under testing and should be used with care. Next release will be v2.0 after complete testing of the software.

Meanwhile, you can report any issues you found using `GitHub Issues <https://github.com/lalluanthoor/www/issues>`_ page.

*********
Changelog
*********

* Commit: 01-08-2015 9.40PM - Release v2.0.1

  * Added page rendering time to footer
  * Added Fine for delayed return of books

* Commit: 26-07-2015 10.00AM - Release v1.9.5

  * Added option for Users to suggest books
  * Added option for Librarians to view suggestions
  * Restructured menu for Librarians
  * Action Icons on buttons for Users and Librarians
  * Revised DB copy is ``db_backup`` folder

* Commit: 25-07-2015 9.30PM - Release v1.9.1

  * Enhanced security by improving validation at server side
  * Renamed CI Application and System Folders
  * Updated DB file in ``db_backup`` folder
  * Limited renewal of books to a single time, prior to expiration of lease
  * Imposed maximum limit on number of books to lease
  * Displays Copy ID in book views and issue views
  * Separate listing of copies
  * View code standardized to ``<?= ... ?>`` format for printing
  * User can view his issues only, Librarian can view all
  * Bug fixes

* Commit: 23-07-2015 8.50PM - Release v1.8

  * Added profile picture for User
  * Revised DB in ``db_backup`` folder
  * Fixed UI issues related to profile picture for Librarian

* Commit: 23-07-2015 8.00PM - Release v1.4.3

  * Added profile picture for Librarian

* Commit: 20-07-2015 10.10PM - Release v1.3

  * Added validation at front-end and back-end
  * Fixed overflow of dialog box contents

* Commit: 20-07-2015 3.00PM

  * Added Password Change feature for Librarian and User

* Commit: 20-07-2015 12.01PM - Release v1.0

  * Finished User menu for Librarian
  * Finished Profile menu for User and Librarian

* Commit: 19-07-2015 11.05PM

  * Finished Issue menu for Librarian
  * Created separate models for DBs

* Commit: 19-07-2015 11.30AM

  * Finished Book menu for Librarian
  
* Commit: 18-07-2015 11.40PM

  * Finished UI design for Librarian
  * Finished UI design for User
  * Changes in Look and Feel

* Commit: 18-07-2015 3.30PM

  * Added DataTables for displaying tables
  * Separated User and Librarian views
  * Completed User->View menu
  * Completed Librarian->View menu
  * UI completed for Librarian->Books menu


*******************
Server Requirements
*******************

PHP version 5.4 or newer is recommended.

It should work on 5.2.4 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

MySQL 5.6 is used for the development. It will run fine on MySQL 5.5 or above.

************
Installation
************

To install this software, copy the source tree into your server's root directory. The database with sample values are given in ``db_backup`` folder. Import it into your database. Configure your dabase parameters in the file ``ci_application/config/database.php``.

*******
License
*******

Please see the `license
agreement <https://github.com/lalluanthoor/www/blob/master/license.txt>`_.

************
CI Resources
************

-  `User Guide <http://www.codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community IRC <http://www.codeigniter.com/irc>`_

Report security issues to `Security Panel <mailto:security@codeigniter.com>`_, thank you.

***************
Acknowledgement
***************

I would like to thank The CodeIgniter team, EllisLab, DataTables team, Jasny Bootstrap,
all the contributors to the CodeIgniter project and you, the CSEDL Manager user.