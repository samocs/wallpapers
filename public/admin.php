<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Admin Dashboard</title>
  <style>
    :root{
    --bg:#0f172a;
      --panel:#111827;
      --panel-2:#1f2937;
      --text:#e5e7eb;
      --muted:#9ca3af;
      --primary:#38bdf8;
      --danger:#ef4444;
      --success:#22c55e;
    }
    *{box-sizing:border-box}
    body{
    margin:0;
    font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,"Helvetica Neue",Arial;
      background:var(--bg);
      color:var(--text);
    }
    .layout{
    display:grid;
    grid-template-columns:260px 1fr;
      min-height:100vh;
    }
    aside{
    background:var(--panel);
    padding:24px;
      border-right:1px solid #1f2937;
    }
    .brand{
    font-weight:700;
      font-size:20px;
      margin-bottom:24px;
    }
    .nav a{
    display:block;
    color:var(--text);
    text-decoration:none;
      padding:10px 12px;
      border-radius:8px;
      margin-bottom:6px;
    }
    .nav a.active,.nav a:hover{background:var(--panel-2)}
    main{padding:24px}
    .topbar{
    display:flex;
    justify-content:space-between;
      align-items:center;
      margin-bottom:20px;
    }
    .stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
      gap:16px;
      margin-bottom:20px;
    }
    .card{
    background:var(--panel);
    padding:16px;
      border-radius:12px;
      border:1px solid #1f2937;
    }
    .card h3{margin:0 0 6px 0;font-size:14px;color:var(--muted)}
    .card .value{font-size:22px;font-weight:700}
    .actions{
    display:flex;
    gap:10px;
    }
    .btn{
    border:0;
    padding:10px 14px;
      border-radius:8px;
      cursor:pointer;
      background:var(--primary);
      color:#0b1220;
      font-weight:600;
    }
    .btn.secondary{background:#334155;color:var(--text)}
    .btn.danger{background:var(--danger);color:white}
    .table-wrap{
        background:var(--panel);
        border:1px solid #1f2937;
      border-radius:12px;
      overflow:hidden;
    }
    table{
        width:100%;
        border-collapse:collapse;
    }
    th,td{
        padding:12px 14px;
      border-bottom:1px solid #1f2937;
      text-align:left;
      font-size:14px;
    }
    th{color:var(--muted);font-weight:600}
    tr:hover{background:#0b1220}
        .tag{
            display:inline-block;
            padding:4px 8px;
      border-radius:999px;
      font-size:12px;
      background:#1e293b;
      color:var(--muted);
    }
    .thumb{
            width:48px;height:32px;border-radius:6px;object-fit:cover;
      border:1px solid #1f2937;
    }
    .modal{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.6);
            display:none;
            align-items:center;
      justify-content:center;
      padding:16px;
    }
    .modal.open{display:flex}
    .modal-content{
            background:var(--panel);
            border:1px solid #1f2937;
      border-radius:12px;
      width:100%;
      max-width:520px;
      padding:20px;
    }
    .field{margin-bottom:12px}
    label{display:block;margin-bottom:6px;color:var(--muted);font-size:12px}
    input,select,textarea{
            width:100%;
            padding:10px;
      border-radius:8px;
      border:1px solid #1f2937;
      background:#0b1220;
      color:var(--text);
    }
    .modal-actions{
            display:flex;justify-content:flex-end;gap:10px;margin-top:12px;
    }
    .footer-note{margin-top:12px;color:var(--muted);font-size:12px}
    @media (max-width:900px){
            .layout{grid-template-columns:1fr}
      aside{display:none}
    }
  </style>
</head>
<body>
<div class="layout">
  <aside>
    <div class="brand">Admin Console</div>
    <nav class="nav">
      <a class="active" href="#">Dashboard</a>
      <a href="#">Images</a>
      <a href="#">Posts</a>
      <a href="#">Categories</a>
      <a href="#">Users</a>
      <a href="#">Settings</a>
    </nav>
  </aside>

  <main>
    <div class="topbar">
      <div>
        <h2 style="margin:0 0 6px">Content Manager</h2>
        <div class="tag">Manage images & posts</div>
      </div>
      <div class="actions">
        <button class="btn secondary" id="newPostBtn">New Post</button>
        <button class="btn" id="newImageBtn">Upload Image</button>
      </div>
    </div>

    <div class="stats">
      <div class="card">
        <h3>Total Images</h3>
        <div class="value" id="statImages">128</div>
      </div>
      <div class="card">
        <h3>Total Posts</h3>
        <div class="value" id="statPosts">42</div>
      </div>
      <div class="card">
        <h3>Drafts</h3>
        <div class="value" id="statDrafts">7</div>
      </div>
      <div class="card">
        <h3>Storage Used</h3>
        <div class="value" id="statStorage">3.4 GB</div>
      </div>
    </div>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Preview</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Updated</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="contentTable">
          <tr>
            <td><img class="thumb" src="https://picsum.photos/seed/1/120/80" alt=""></td>
            <td>Sunset Valley</td>
            <td>Image</td>
            <td><span class="tag">Published</span></td>
            <td>2026-04-26</td>
            <td>
              <button class="btn secondary" onclick="openEdit('Sunset Valley')">Edit</button>
              <button class="btn danger" onclick="removeItem(this)">Delete</button>
            </td>
          </tr>
          <tr>
            <td><img class="thumb" src="https://picsum.photos/seed/2/120/80" alt=""></td>
            <td>Weekly Update #12</td>
        <td>Post</td>
            <td><span class="tag">Draft</span></td>
            <td>2026-04-25</td>
            <td>
              <button class="btn secondary" onclick="openEdit('Weekly Update #12')">Edit</button>
              <button class="btn danger" onclick="removeItem(this)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="footer-note">Hook up the buttons to your backend endpoints (create/update/delete).</div>
  </main>
</div>

<!-- Modal -->
<div class="modal" id="modal">
  <div class="modal-content">
    <h3 id="modalTitle">Create</h3>
    <div class="field">
      <label>Title</label>
      <input id="titleInput" placeholder="Title..."/>
    </div>
    <div class="field">
      <label>Type</label>
      <select id="typeInput">
        <option>Image</option>
        <option>Post</option>
      </select>
    </div>
    <div class="field">
      <label>Status</label>
      <select id="statusInput">
        <option>Draft</option>
        <option>Published</option>
      </select>
    </div>
    <div class="field">
      <label>Description</label>
      <textarea id="descInput" rows="3" placeholder="Optional..."></textarea>
    </div>
    <div class="modal-actions">
      <button class="btn secondary" onclick="closeModal()">Cancel</button>
      <button class="btn" onclick="saveItem()">Save</button>
    </div>
  </div>
</div>

<script>
  const modal = document.getElementById('modal');
  const modalTitle = document.getElementById('modalTitle');

  document.getElementById('newImageBtn').onclick = () => openCreate('Image');
  document.getElementById('newPostBtn').onclick = () => openCreate('Post');

  function openCreate(type){
      modalTitle.textContent = `Create ${type}`;
      document.getElementById('typeInput').value = type;
      document.getElementById('titleInput').value = '';
      document.getElementById('statusInput').value = 'Draft';
      document.getElementById('descInput').value = '';
      modal.classList.add('open');
  }
  function openEdit(title){
      modalTitle.textContent = `Edit "${title}"`;
      document.getElementById('titleInput').value = title;
      modal.classList.add('open');
  }
  function closeModal(){
      modal.classList.remove('open');
  }
  function saveItem(){
      // TODO: connect to backend API
      alert('Saved (wire to backend)');
      closeModal();
  }
  function removeItem(btn){
      if(confirm('Delete this item?')){
          btn.closest('tr').remove();
      }
  }
</script>
</body>
</html>