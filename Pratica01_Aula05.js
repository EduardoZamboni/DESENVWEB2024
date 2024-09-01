function clearDisplay() {
    document.getElementById('display').value = '';
    document.getElementById('display').style.backgroundColor = '#fff';
}

function appendToDisplay(value) {
    document.getElementById('display').value += value;
}

function calculate() {
    const display = document.getElementById('display');
    try {
        const result = eval(display.value);
        display.value = result;
        if (result > 0) {
            display.style.backgroundColor = 'lightgreen';
        } else if (result < 0) {
            display.style.backgroundColor = 'lightcoral';
        } else {
            display.style.backgroundColor = 'lightgrey';
        }
    } catch (error) {
        display.value = 'Erro';
        display.style.backgroundColor = 'lightcoral';
    }
}
