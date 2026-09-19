
/* ---------------- Data model ---------------- */
const PRODUCTS = [
  { name:"Amber Oak Dining Table", color:"#B98849", units:184 },
  { name:"Meridian Sofa — 3 Seater", color:"#4F6F52", units:151 },
  { name:"Linden Wardrobe", color:"#6B4A34", units:122 },
  { name:"Haven Bed Frame — Queen", color:"#A6483C", units:97 },
  { name:"Nook Accent Chair", color:"#8C7E6B", units:76 }
];

const CUSTOMERS = ["Farhan Rahman","Nusrat Jahan","Tanvir Ahmed","Sadia Islam","Kamrul Hasan","Mim Akter","Riad Chowdhury","Afsana Karim"];
const STATUSES = ["Delivered","Pending","Cancelled"];

function rand(min,max){ return Math.floor(Math.random()*(max-min+1))+min; }

function generateSeries(days){
  const base = 40000;
  const cur = [], prev = [];
  for(let i=0;i<days;i++){
    cur.push(base + rand(-8000, 15000) + i*rand(200,600));
    prev.push(base + rand(-10000, 9000) + i*rand(100,400));
  }
  return { cur, prev };
}

function generateOrders(n){
  const rows = [];
  for(let i=0;i<n;i++){
    const product = PRODUCTS[rand(0,PRODUCTS.length-1)];
    rows.push({
      id: "NX-" + rand(10000,99999),
      product: product.name,
      color: product.color,
      customer: CUSTOMERS[rand(0,CUSTOMERS.length-1)],
      amount: rand(3500, 42000),
      status: STATUSES[rand(0,9) < 6 ? 0 : (rand(0,9) < 8 ? 1 : 2)]
    });
  }
  return rows;
}

function bdt(n){ return "৳" + n.toLocaleString("en-IN"); }

/* ---------------- Render functions ---------------- */
let revenueChart, statusChart;
let currentOrders = [];

function renderKPIs(range){
  const totalRevenue = rand(range*35000, range*62000);
  const totalOrders = rand(range*10, range*22);
  const newCustomers = rand(range*3, range*9);
  const lowStock = rand(3, 11);

  document.getElementById("kpiRevenue").textContent = bdt(totalRevenue);
  document.getElementById("kpiOrders").textContent = totalOrders;
  document.getElementById("kpiCustomers").textContent = newCustomers;
  document.getElementById("kpiLowStock").textContent = lowStock;

  document.getElementById("kpiRevenueTrend").textContent = rand(4,22) + "%";
  document.getElementById("kpiOrdersTrend").textContent = rand(2,18) + "%";
  document.getElementById("kpiCustomersTrend").textContent = rand(1,15) + "%";
}

function renderRevenueChart(range){
  const labels = Array.from({length:range}, (_,i) => "Day " + (i+1));
  const { cur, prev } = generateSeries(range);

  if(revenueChart) revenueChart.destroy();
  const ctx = document.getElementById("revenueChart");
  revenueChart = new Chart(ctx, {
    type:"line",
    data:{
      labels,
      datasets:[
        {
          label:"This period",
          data:cur,
          borderColor:"#B98849",
          backgroundColor:"rgba(185,136,73,0.12)",
          tension:.35, fill:true, pointRadius:0, borderWidth:2.5
        },
        {
          label:"Previous",
          data:prev,
          borderColor:"#D8CFBF",
          backgroundColor:"transparent",
          tension:.35, fill:false, pointRadius:0, borderWidth:2, borderDash:[4,4]
        }
      ]
    },
    options:{
      plugins:{ legend:{ display:false } },
      scales:{
        x:{ grid:{ display:false }, ticks:{ display: range<=30, maxTicksLimit:8, color:"#8A7C6C", font:{size:11} } },
        y:{ grid:{ color:"#EFE9DE" }, ticks:{ color:"#8A7C6C", font:{size:11}, callback:v=>"৳"+(v/1000)+"k" } }
      },
      interaction:{ intersect:false, mode:"index" }
    }
  });
}

function renderStatusChart(){
  if(statusChart) statusChart.destroy();
  const counts = { Delivered:0, Pending:0, Cancelled:0 };
  currentOrders.forEach(o => counts[o.status]++);

  const ctx = document.getElementById("statusChart");
  statusChart = new Chart(ctx, {
    type:"doughnut",
    data:{
      labels:["Delivered","Pending","Cancelled"],
      datasets:[{
        data:[counts.Delivered, counts.Pending, counts.Cancelled],
        backgroundColor:["#4F6F52","#B98849","#A6483C"],
        borderWidth:0
      }]
    },
    options:{
      cutout:"68%",
      plugins:{ legend:{ position:"bottom", labels:{ boxWidth:9, boxHeight:9, usePointStyle:true, color:"#5A4E40", font:{size:12} } } }
    }
  });
}

function statusClass(s){
  if(s === "Delivered") return "status-delivered";
  if(s === "Pending") return "status-pending";
  return "status-cancelled";
}

function renderOrdersTable(filter=""){
  const tbody = document.getElementById("ordersBody");
  const f = filter.trim().toLowerCase();
  const rows = currentOrders.filter(o =>
    !f || o.id.toLowerCase().includes(f) || o.product.toLowerCase().includes(f) || o.customer.toLowerCase().includes(f)
  ).slice(0,8);

  tbody.innerHTML = rows.map(o => `
    <tr>
      <td class="fw-semibold">${o.id}</td>
      <td>
        <div class="prod-cell">
          <span class="prod-swatch" style="background:${o.color}"></span>
          <span>${o.product}</span>
        </div>
      </td>
      <td>${o.customer}</td>
      <td>${bdt(o.amount)}</td>
      <td><span class="status-badge ${statusClass(o.status)}">${o.status}</span></td>
    </tr>
  `).join("") || `<tr><td colspan="5" class="text-center text-muted py-4">No matching orders</td></tr>`;
}

function renderTopProducts(){
  const max = Math.max(...PRODUCTS.map(p=>p.units));
  document.getElementById("topProducts").innerHTML = PRODUCTS.map(p => `
    <div class="top-product">
      <span class="sw" style="background:${p.color}"></span>
      <div class="flex-grow-1">
        <div class="d-flex justify-content-between">
          <span class="small fw-medium">${p.name}</span>
          <span class="small text-muted">${p.units} sold</span>
        </div>
        <div class="bar"><span style="width:${(p.units/max*100).toFixed(0)}%"></span></div>
      </div>
    </div>
  `).join("");
}

function renderStockAlerts(){
  const items = [
    { name:"Haven Bed Frame — Queen", left: 4 },
    { name:"Meridian Sofa — 3 Seater", left: 6 },
    { name:"Oakline Coffee Table", left: 2 },
    { name:"Nook Accent Chair", left: 8 }
  ];
  document.getElementById("stockAlerts").innerHTML = items.map(i => `
    <div class="stock-item d-flex justify-content-between align-items-center">
      <span class="small">${i.name}</span>
      <span class="stock-badge" style="background:${i.left<=3?'var(--brick-soft)':'var(--brass-soft)'};color:${i.left<=3?'var(--brick)':'#8C6431'};">${i.left} left</span>
    </div>
  `).join("");
}

/* ---------------- Init & interactivity ---------------- */
function loadRange(days){
  currentOrders = generateOrders(rand(20,30));
  renderKPIs(days);
  renderRevenueChart(days);
  renderStatusChart();
  renderOrdersTable(document.getElementById("globalSearch").value);
}

document.getElementById("rangePill").addEventListener("click", (e) => {
  const btn = e.target.closest("button");
  if(!btn) return;
  document.querySelectorAll("#rangePill button").forEach(b=>b.classList.remove("active"));
  btn.classList.add("active");
  loadRange(parseInt(btn.dataset.range));
});

document.getElementById("globalSearch").addEventListener("input", (e) => {
  renderOrdersTable(e.target.value);
});




const sidebar = document.getElementById("sidebar");
const backdrop = document.getElementById("backdrop");
document.getElementById("menuToggle").addEventListener("click", () => {
  sidebar.classList.toggle("show");
  backdrop.classList.toggle("d-none");
});
backdrop.addEventListener("click", () => {
  sidebar.classList.remove("show");
  backdrop.classList.add("d-none");
});

renderTopProducts();
renderStockAlerts();
loadRange(7);

/* ---------------- Settings modal ---------------- */
document.querySelectorAll("#settingsTabs .nav-link").forEach(tabBtn => {
  tabBtn.addEventListener("click", () => {
    document.querySelectorAll("#settingsTabs .nav-link").forEach(b => b.classList.remove("active"));
    document.querySelectorAll(".settings-pane").forEach(p => p.classList.add("d-none"));
    tabBtn.classList.add("active");
    document.getElementById(tabBtn.dataset.tabTarget).classList.remove("d-none");
  });
});

// Jump straight to the settings tab when opened from that menu item
document.querySelectorAll('[data-bs-target="#profileModal"]').forEach(trigger => {
  trigger.addEventListener("click", () => {
    if(trigger.dataset.tab === "settings"){
      document.querySelector('[data-tab-target="tab-security"]').click();
    } else {
      document.querySelector('[data-tab-target="tab-profile"]').click();
    }
  });
});

// Keep the initials avatar in sync with the name field
document.getElementById("profNameInput").addEventListener("input", (e) => {
  const initials = e.target.value.trim().split(/\s+/).map(w=>w[0]).slice(0,2).join("").toUpperCase() || "?";
  document.querySelectorAll(".avatar-upload, .topbar .avatar").forEach(el => {
    el.childNodes[0].nodeValue = initials + " ";
  });
});

document.getElementById("saveProfileBtn").addEventListener("click", (e) => {
  const btn = e.target;
  const original = btn.textContent;
  btn.textContent = "Saved ✓";
  btn.disabled = true;
  setTimeout(() => {
    btn.textContent = original;
    btn.disabled = false;
    bootstrap.Modal.getInstance(document.getElementById("profileModal")).hide();
  }, 900);
});
