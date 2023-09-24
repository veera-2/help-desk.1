function tickets(){

    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_ticket.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let tickets = JSON.parse(this.responseText);

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "13px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("User");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Title");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Description");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Date logged");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Category");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Priority");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_7 = document.createElement("th");
            th_7.setAttribute("scope","col");
            th_7_text = document.createTextNode("Action");
            th_7.appendChild(th_7_text)
            th_tr.appendChild(th_7);
            
            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in tickets) {

                
                if (tickets[i].assignee_id == null) {

                    let code = "code";

                    let tr = document.createElement("tr");

                    let td_1 = document.createElement("td");
                    td_1_text = document.createTextNode(tickets[i].complainant_id);
                    td_1.appendChild(td_1_text);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(tickets[i].ticket_title);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(tickets[i].ticket_description);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(tickets[i].date_logged);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(tickets[i].category_description);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(tickets[i].priority_description);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_7 = document.createElement("td");

                    let button_1 = document.createElement("button");

                    button_1.setAttribute("type", "button");
                    button_1.setAttribute("onclick", "assign_ticket()");
                    button_1.setAttribute("id", "assign_btn");
                    button_1.classList.add("btn");
                    button_1.classList.add("btn-primary");
                    button_1.classList.add("btn-sm");
                    button_1.classList.add("assign_btn");

                    let i_1 = document.createElement("i");

                    i_1.classList.add("far")
                    i_1.classList.add("fa-share-square")

                    button_1.appendChild(i_1)

                    let button_2 = document.createElement("button");

                    button_2.setAttribute("type", "button");
                    button_2.classList.add("btn");
                    button_2.classList.add("btn-primary");
                    button_2.classList.add("btn-sm");

                    let i_2 = document.createElement("i");

                    i_2.classList.add("far")
                    i_2.classList.add("fa-share-square")

                    button_2.appendChild(i_2)

                    td_7.appendChild(button_1)
                    tr.appendChild(td_7);

                    tbody.appendChild(tr);

                }

            }

            table.appendChild(tbody);

            document.querySelector("#table_container").appendChild(table);
            
        }
    }
    xhr.send();
}