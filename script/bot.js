isOpen = true;
const Discord = require('discord.js');
const client = new Discord.Client();
const PLAP_GUILD = '359021034109665290';
const BOT_CHAN = '361958161512660994';
const GROUPS_MAPPING = {'2':'359021930428497932', '4':'359704986268991489', '5':'359021936602513430'}; //, '3':'359021630346756096'
const mysql = require('mysql');
const CON_DATA = {
					host: "localhost",
					user: "bot-plap",
					password: "DNzV9BtzZWdl7KT",
					database: "plap"
				}
				
/*const CON_DATA = {
					host: "localhost",
					user: "root",
					password: "",
					database: "plap"
				}*/




client.on('ready', () => {
	console.log('I am ready!');
});

client.on('disconect', () => {
	login();
});


client.on('message', function(message) {

	//message personelle
	if(message.channel.type == 'dm' && !message.author.bot){

		var id = message.author.id;
		
		//console.log(client.guilds.get(PLAP_GUILD).member(message.author));

		var con = mysql.createConnection(CON_DATA);
		con.connect(function(err) {
			if (err) throw err;
			con.query("SELECT * FROM user WHERE discord_random_string='" + message.content + "';", function (err, result, fields) {
				if (err) throw err;		

				if(result.length == 1){					
				
				var sql = "UPDATE user SET discord_id = " + id + " WHERE discord_random_string='" + message.content + "';";
				con.query(sql, function (err, result) {
					if (err) throw err;
					if(result.affectedRows == 1){
						message.author.send('Liaison effectue avec succee. Update de vos role');
						var users =  client.guilds.get(PLAP_GUILD).members.get(id);;
						client.guilds.get(PLAP_GUILD).channels.get(BOT_CHAN).send('!update_roles ' + users);
					} else{
						message.author.send('Une erreur est survenu.');
					}				
					
				});
				}
				else{
					message.author.send('Le token n a pas etait trouve dans la base donnee. Veut tu un tuto pour copier coller?');
				}
				
			});
		});
		
	}
	else if (!message.content.startsWith('!') || message.channel.id != BOT_CHAN)  return; //autre message non command
	
	//command
	else{
		if(message.content.startsWith('!bot')){
			bot(message);
		}
		else if(message.content.startsWith('!liste_guilds')){
			liste_guild(message);
		}
		else if(message.content.startsWith('!liste_chans')){
			liste_chans(message);
		}
		else if(message.content.startsWith('!liste_roles')){
			liste_roles(message);
		}
		else if(message.content.startsWith('!liste_membre')){
			liste_membre(message);
		}
		else if(message.content.startsWith('!update_roles') || message.content.startsWith('!ur')){
			update_roles(message);
		}
		else if(message.content.startsWith('!help') || message.content.startsWith('!h')){
			help(message);
		}
		else if(message.content.startsWith('!test')){
			test(message);
		}
	}
	
});


function help(message){
	message.channel.send('Voici la liste des commandes');
	message.channel.send(' \'!help\' alias : \'!h\' -> montre ce message');
	message.channel.send(' \'!bot\' -> test si le bot est toujour vivant');
	message.channel.send(' \'!update_roles <user>\' alias : \'!up\' -> update les roles d\'un ou plusieur membre');
	message.channel.send(' \'!liste_guilds -> Liste les guilds du bot');
	message.channel.send(' \'!liste_chans -> Liste les du serveur');
	message.channel.send(' \'!liste_roles -> Liste les roles du serveur');
	message.channel.send(' \'!liste_membre -> Liste les membres du serveur');
}

function bot(message){
	message.channel.send('Toujour vivant!');
}


function liste_guilds(message){
	var guilds = client.guilds;
	
	for (var [id, guild] of guilds) {
		message.channel.send (id + ' => ' + guild.name);
	}
}

function liste_chans(message){
	var channels = client.guilds.get(PLAP_GUILD).channels;
	
	for (var [id, channel] of channels) {
		message.channel.send (id + ' => ' + channel.name);
	}
}

function liste_roles(message){
	var roles = client.guilds.get(PLAP_GUILD).roles;
	
	for (var [id, role] of roles) {
		message.channel.send (id + ' => ' + role.name);
	}
}
function liste_membre(message){
	var members = client.guilds.get(PLAP_GUILD).members;
	
	for (var [id, member] of members) {
		message.channel.send (id + ' => ' + member.user.username);
	}
}

function test(message){
	var members = message.mentions.users.array();
	
	
	if(members === undefined || members.length < 1 || members.length > 1) {
		message.channel.send ('Merci de mentionner UN membre a tester'); 
		return;
	}
	else{
		members[0].send('Le discord fonctionne');
			
	}
}

function update_roles(message){
	
	
	
	var members = message.mentions.users.array();
	//console.log(members);
	
	//test si il y a un ou plusieur membre de mentionner dans le message
	if(members === undefined || members.length < 1 || members.length > 1) {
		message.channel.send ('Merci de mentionner UN membre a update'); 
		return;
	}
	else{
		//message.channel.send ('Update des roles...');
			//for (var i in members) {
		update_roles_member(message, members[0]);
			//}
			
	}
		
}

function update_roles_member(message, member){
	var con = mysql.createConnection(CON_DATA);
	
	message.channel.send ('Update des roles de ' + member);
	//messageTmp = '|---Update des roles de ' + member + '\n';
	

			
	con.connect(function(err, messageTmp) {
		if (err) throw err;
		con.query("SELECT * FROM user WHERE discord_id='" + member.id + "';", function (err, result, fields, messageTmp) {
			if (err) throw err;
				if(result.length == 0){
					message.channel.send ('Membre ' + member + ' non trouve dans la base de donnee. A-t-il fait l\'api discord sur le site -> <TODO:link>?');
					
					//messageTmp = messageTmp + '|---Membre <@' + member.username + '> non trouve dans la base de donnee. A-t-il fait l\'api discord sur le site -> <TODO:link>?';
						}
						else{
							con.query("SELECT * FROM user_groupe WHERE user_id='" + result[0].id + "';", function (err, result, fields, messageTmp) {
							if (err) throw err;
							var tmp = client.guilds.get(PLAP_GUILD).members.get(member.id);
							for (var key in GROUPS_MAPPING) {
								//console.log('lel');
								hasGroupInDB = false;
								for(var group of result){
									if(group.groupe_id == key) hasGroupInDB = true;
								}
								//console.log(hasGroupInDB);
								var role = client.guilds.get(PLAP_GUILD).roles.get(GROUPS_MAPPING[key])
								hasGroupInDiscord = tmp.roles.has(GROUPS_MAPPING[key]);
								
								if(hasGroupInDB && hasGroupInDiscord){
									message.channel.send ('    |---Role ' + role + ' deja attribué.' );
								}
								else if(hasGroupInDB && !hasGroupInDiscord){
									tmp.addRole(role);
									message.channel.send ('    |---Ajout du role ' + role + '.' );
								}
								else if(!hasGroupInDB && hasGroupInDiscord){
									tmp.removeRole(role);
									message.channel.send ('    |---Suppression du role ' + role + '.' );
								}
								
								
							}
							/*for(var group of result){								
								if(GROUPS_MAPPING[group.groupe_id] != undefined){									
									
									
									var role = client.guilds.get(PLAP_GUILD).roles.get(GROUPS_MAPPING[group.groupe_id])
									tmp.addRole(role);
									
									
									
									message.channel.send ('    |---Ajout du role ' + role + '.' );
									//messageTmp = messageTmp + '    |---Ajout du role ' + role + '.' + '\n';
									
									
								}
							}*/
							member.send('Vos roles sur le serveur ' + client.guilds.get(PLAP_GUILD) + ' on etaient update');
							//message.channel.send (messageTmp);

						});
					}
					con.end();
				});
			});
			
		

	
	
}


function login(){
	if(isOpen){
		try{
                	client.login('MzYxOTUxMjIyOTg4NjY4OTI5.DKw19Q.fCzc-vAGGTBypn0SwlHPghIwSwA');
               		// console.log('lel');
        	}
        	catch (err){
                	consolle.error('network error');
			login();
        	}

	}
}

login();
