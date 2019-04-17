// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   todo.js                                            :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: minakim <marvin@42.fr>                     +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2019/04/05 15:12:17 by minakim           #+#    #+#             //
//   Updated: 2019/04/05 20:11:41 by minakim          ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

var flag = 0;
var index = 0;
var arr = [];

function create(list)
{
	if (flag == 0)
		var task = prompt("Today's Task");
	else
		var task = list;
	if (task)
	{
		var todo = document.getElementById("ft_list");
		var new_todo = document.createElement("div");
		new_todo.setAttribute("class", "newelem");
		new_todo.setAttribute("onclick", "delete_list(this)");
		new_todo.setAttribute("index", index);
		var text = document.createTextNode(task);
		arr[index] = task;
		index++;
		new_todo.appendChild(text);
		todo.insertBefore(new_todo, todo.childNodes[0]);
		if (flag == 0)
			update_cookies();
	}
}

function delete_list(list)
{
	if (confirm("Delete?") == true)
	{
		var del = list.getAttribute("index");
		arr.splice(del, 1);
		list.parentNode.removeChild(list);
		update_cookies();
	}
}

function update_cookies()
{
	var js_str = JSON.stringify(arr);
	document.cookie = "thingstodo="+js_str;
}

window.onload = function()
{
	if (document.cookie)
	{
		flag = 1;
		var cooki = document.cookie;
		var newtab = cooki.split("=");
		var test = JSON.parse(newtab[1]);
		for (list in test)
			create(test[list]);
		flag = 0;
	}
}
