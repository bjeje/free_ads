Bonjour {{$email_data['firstname']}}
<br><br>
Bienvenue sur Free ads!
<br>
Une demande d'inscription à été enregistré a votre e-mail souhaitez vous confirmer votre inscription?
<br>
Merci de cliquer sur le lien ci dessous pour confirmer !
<br><br>
http://127.0.0.1:8000/register
<a href="http://127.0.0.1:8000/verify?code={{$email_data['verification_code']}}">Cliquez ici!</a>
<!--<a href="http://localhost/my_tuts/send-emails/blog/public/verify?code={{$email_data['verification_code']}}">Click Here!</a>-->

<br><br>
Merci !
<br>
Free ads
