This is a quiz Platform made in PHP using MVC architecture

Steps to deploy QuizBox:

1. git clone https://github.com/ani1998ket/QuizBox2.git ~/mvc
2. cd ~/mvc
3. Change the paths in mvc.quizbox.local.conf pointing to the public folder of this project
4. sudo cp ~/mvc/mvc.quizbox.local.conf /etc/apache2/sites-available/.
5. Add mvc.quizbox.local entry to your /etc/hosts
6. sudo a2ensite mvc.quizbox.local.conf
7. sudo service apache2 restart
8. Open http://mvc.quizbox.local in your browser