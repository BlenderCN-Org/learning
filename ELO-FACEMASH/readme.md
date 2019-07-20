While watching the movie <a href="https://www.imdb.com/title/tt1285016/">The Social Network</a>, about Mark Zuckerberg when he founded Facebook while at Harvard, I saw the part where they come up with the initial idea for Facemash, a website which would later be used to rate pictures of girls at Harvard (similar to Hot or Not, a more popular version), which was actually a precursor to Facebook.  During one of the scenes, Mark consults with his friend about the algorithm, which is written on a blackboard.  Since the movie glorifies the algorithm, I wanted to explore it further and actually apply it to some kind of app, and what better than similar to the original Facemash, which used the original algorithm?  At the time of this writing, there isn't any sites I could find that makes use of it, but only pages that discuss it.

Here is a still image from the movie of the algorithm on the blackboard: https://i.pinimg.com/originals/fc/ff/a0/fcffa093c3ba1dd02ebda0e5a83388c1.png

Obvious Note:  I did NOT write/invent the ELO rating formula/algorithm.  I am just studying and applying it since it's been used in software numerous times.  I'm sure I don't really need to say this, however.  Also, don't criticize my use of antiquated HTML techniques such as <font color -- I am merely using it out of ease.

<hr>

Description of Files:<br/>
• ELO.php - a standalone, browser-based, file which shows and explains the algorithm in detail.  It would be redundant to explain more here.<br/>
• First_Page.php - The first page of my ELO example.

<hr>

What I've learned about the ELO formula:<br/>
• Quite literally (as Wikipedia suggests), the ONLY information you need to predict future winnings is their current score.
• It is used on a game-per-game basis (the algorithm/formula must be ran after each game), but could be ran retroactively mathematically.<br/> 
• Because of the first point, it provides a running, cumulative, prediction of who is the stronger player based on previous wins against opponents.<br/>
• ELO doesn't determine the number of points lost (as far as I can tell), and only serves as a predictor of who will win depending on score.<br/>
• ELO seems to serve as a pretty good predictor of who will win, if the only criteria being measured is score.