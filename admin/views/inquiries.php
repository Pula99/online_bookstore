<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #007b73;
        color: #fff;
    }

    button {
        background-color: #00AA91;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
</style>

<div class="main-container">
    <div class="wrapper">
        <div id="inquiries-table-container" style="overflow: auto;"></div>
    </div>
</div>

<script>
    // Fetch inquiries from the backend and populate the table
    fetch('admin/Ajax.php?ajax=view_inq', {
        method: 'GET',
        headers: {
            'X-Ajax-Request': 'true' // to identify AJAX requests
        }
    })
    .then(response => response.json())
    .then(inquiries => {
        const tableContainer = document.getElementById('inquiries-table-container');
        if (inquiries.length > 0) {
            const table = createInquiriesTable(inquiries);
            tableContainer.appendChild(table);
        } else {
            tableContainer.textContent = 'No inquiries found!';
        }
    })
    .catch(error => console.error('Error fetching inquiries:', error));

    function createInquiriesTable(inquiries) {
        const table = document.createElement('table');
        const headerRow = table.insertRow();
        const headers = ['Inquiry ID', 'First Name', 'Last Name', 'Email', 'Book Name', 'Comment', 'Date', 'Action'];

        // Create table headers
        headers.forEach(headerText => {
            const th = document.createElement('th');
            th.textContent = headerText;
            headerRow.appendChild(th);
        });

        // Create table rows for each inquiry
        inquiries.forEach(inquiry => {
            const row = table.insertRow();
            Object.keys(inquiry).forEach(key => {
                const cell = row.insertCell();
                if (inquiry[key] === '') {
                    cell.textContent = 'N/A';
                } else {
                    cell.textContent = inquiry[key];
                }
            });

            // Create action cell with the "Send Email" button
            const actionCell = row.insertCell();
            const sendEmailBtn = document.createElement('button');
            sendEmailBtn.textContent = 'Send Email';
            sendEmailBtn.addEventListener('click', () => {
                window.location.href = `mailto:${inquiry['email']}`;
            });
            actionCell.appendChild(sendEmailBtn);
        });

        return table;
    }
</script>


