function openTab(evt, tabName) {
    var i, tab_items;

    /* Hide all tabs */
    var tabs = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tab_items = document.getElementsByClassName("tab-item");
    for (i = 0; i < tab_items.length; i++) {
        tab_items[i].className = tab_items[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
