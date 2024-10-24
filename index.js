function showTab(tabId) {
    const tabs = document.querySelectorAll('.tab-content');
    const buttons = document.querySelectorAll('.tab-button');
    
    tabs.forEach(tab => {
        tab.style.display = 'none';
    });
    
    buttons.forEach(button => {
        button.classList.remove('active');
    });
    
    document.getElementById(tabId).style.display = 'block';
    document.querySelector([onclick="showTab('${tabId}')"]).classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
    showTab('all');
    });