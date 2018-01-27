<?php

/**
 * Created by PhpStorm.
 * User: nadan
 * Date: 31/10/2017
 * Time: 23:02
 */


namespace AppBundle\Discord;

class DiscordConfig
{
    public static $cliendId = '361951222988668929';

    public static $cliendSecret = 'vC1nVx-h938V4Txzspd56RvvIrUdu8dw';

    public static $redirectURI = "http://plapcorp.com/discord/redirect/";

    public static $loginURI = "https://discordapp.com/oauth2/authorize?response_type=code";

    public static $tokenURI = "https://discordapp.com/api/v6/oauth2/token";

    public static $token = 'NDA2Njc3MDc1NTQ2NjAzNTMx.DU2bSw.W-OFEOG6XNNTDBb_H4rYbqn_NtM';

    public static $webhook_url = 'https://discordapp.com/api/webhooks/383371839298207765/MvOKVEt8VpBRxpJOxb9jxW3gP5OKMrjOHSPfkPWbQeIw9eUCuPzX9YmuMsozJ-K1vlKK';
}
