const pusher = new Pusher('75d13e62ff561b491cfe', {
  cluster: 'ap2',
  forceTLS: true
});

const channel = pusher.subscribe('soil-moisture');

channel.bind('thingspeak-data-updated', (data) => {
  alert("OK");

  console.log('Event received:', data);  // For debugging purposes
  if (!data.data) {
    console.log('No data found in the event.');
    return;
  }

  // Clear existing table rows
  const tbody = document.querySelector('table tbody');
  tbody.innerHTML = '';

  // Insert new rows
  data.data.forEach(feed => {
    const tr = document.createElement('tr');
    
    tr.innerHTML = `
      <td>${feed.entry_id}</td>
      <td>${new Date(feed.created_at).toLocaleString()}</td>
      <td>${feed.field1}</td>
      <td>${feed.field2}</td>
      <td>${feed.field3}</td>
      <td>${feed.field4}</td>
      <td>${feed.field5}</td>
      <td>${feed.field6}</td>
      <td>${feed.field7}</td>
      <td>${feed.field8}</td>
    `;
    
    tbody.appendChild(tr);
  });
});