let rowAdded = false;
let columnAdded = false;

function addTotalRow() {
    if (rowAdded) return;

    const tableBody = document.querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');
    const totalRow = document.createElement('tr');
    totalRow.className = 'total-row';

    const totalCell = document.createElement('td');
    totalCell.textContent = 'Médias';
    totalRow.appendChild(totalCell);

    const columnCount = rows[0].cells.length - 1;
    for (let i = 1; i <= columnCount; i++) {
        let sum = 0;
        let count = 0;
        rows.forEach(row => {
            const cellValue = parseFloat(row.cells[i].textContent);
            if (!isNaN(cellValue)) {
                sum += cellValue;
                count++;
            }
        });
        const average = count > 0 ? (sum / count).toFixed(2) : '';
        const avgCell = document.createElement('td');
        avgCell.textContent = average;
        totalRow.appendChild(avgCell);
    }

    tableBody.appendChild(totalRow);
    rowAdded = true;
}

function addTotalColumn() {
    if (columnAdded) return;

    const table = document.querySelector('table');
    const headerRow = table.querySelector('thead tr:nth-child(2)');
    const totalColumnCell = document.createElement('th');
    totalColumnCell.textContent = 'Média';
    headerRow.appendChild(totalColumnCell);

    const bodyRows = table.querySelectorAll('tbody tr');
    bodyRows.forEach(row => {
        const totalCell = document.createElement('td');
        const cells = row.querySelectorAll('td:not(:first-child)');
        let sum = 0;
        let count = 0;
        cells.forEach(cell => {
            const value = parseFloat(cell.textContent);
            if (!isNaN(value)) {
                sum += value;
                count++;
            }
        });
        const average = count > 0 ? (sum / count).toFixed(2) : '';
        totalCell.textContent = average;
        row.appendChild(totalCell);
    });

    const totalRow = document.querySelector('tbody tr.total-row');
    if (totalRow) {
        const avgTotalCell = document.createElement('td');
        avgTotalCell.textContent = '';
        totalRow.appendChild(avgTotalCell);
    }

    columnAdded = true;
}
