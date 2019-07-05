When client logs in, the submit button calls a function on the server named setname(), which then calls getplayers() (found in the client script) which prints out a list of users.


Right now, the client is drawing a block everytime the user presses a key, and a keypress is called by the server to make the player in the firstplace (I think) when the user signs in.

What I did:
- Made the setname() function (on the server) call the below function:

	CPlayerList = new Array(); // an array of player objects
	socket.on('playercreate', function (username, pos, ID) {
		console.log("Playercreate()");
		var Player = new ClientPlayer();
		Player.Create(username, pos, ID);
		CPlayerList.push(Player);
		console.log(JSON.stringify(CPlayerList)); 
    }); 
	
	which then calls Player.Create(username, pos, ID), creating the player.

I should:
- make each player be drawn when the userlist is generated, generating a block for each player.
- then move the users block on client keypress.


In ThreeJS, the cubes need to be created before they're moved.  When are the other players created?  and when is the main player created?