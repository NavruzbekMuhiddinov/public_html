<?php


function setPage($chat_id, $page)
{

file_put_contents(filename:"users/".$chat_id."page.txt", data:$page);


}

function  getPage($chat_id)
{

return file_get_contents(filename:'users/'.$chat_id.'page.txt');

}


function setContact($chat_id, $contact)
{

file_put_contents(filename:"users/".$chat_id."contact.txt", data:$contact);


}

function  getContact($chat_id)
{

return file_get_contents(filename:'users/'.$chat_id.'contact.txt');

}











?>