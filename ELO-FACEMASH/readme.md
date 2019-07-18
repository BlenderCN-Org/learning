While watching the movie The Social Network (https://www.imdb.com/title/tt1285016/?ref_=nv_sr_1?ref_=nv_sr_1), about Mark Zuckerberg when he founded Facebook while at Harvard, I saw the part where they come up with the initial idea for Facemash, a website which would later be used to rate pictures of girls at Harvard (similar to Hot or Not, a more popular version), which was actually a precursor to Facebook.  During one of the scenes, Mark consults with his friend about the algorithm, which is written on a blackboard.  Since the movie glorifies the algorithm, I wanted to explore it further and actually apply it to some kind of app, and what better than similar to the original Facemash, which used the original algorithm?  At the time of this writing, there isn't any sites I could find that makes use of it, but only pages that discuss it.

Here is a still image from the movie of the algorithm on the blackboard: https://i.pinimg.com/originals/fc/ff/a0/fcffa093c3ba1dd02ebda0e5a83388c1.png

Obvious Note:  I did NOT write/invent the ELO rating formula/algorithm.  I am just studying and applying it since it's been used in software numerous times.  I'm sure I don't really need to say this, however.  Also, don't criticize my use of antiquated HTML techniques such as <font color="">.  I am merely using it out of ease.

<hr>

Description of Files:
ELO.php is a standalone, browser-based, file which shows and explains the algorithm in detail.  It would be redundant to explain more here.

----------

What I've learned about the ELO formula:
• It is used on a game-per-game basis (the algorithm/formula must be ran after each game). This means it isn't meant to be used retroactively (at least in its native form).  It needs to be ran after each win/loss, or future scores may not be accurate (right?). 
• Because of the first point, it provides a running, cumulative, prediction of who is the stronger player based on previous wins against opponents, with scores being adjusted each game depending on the strength (difference of scores) of the two players.