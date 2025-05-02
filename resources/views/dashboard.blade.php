<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <title>
   Financial Planner - UMKM Helm &amp; Cuci Helm
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Inter", sans-serif;
    }
    #sidebar {
      transition: transform 0.3s ease;
      width: 240px;
      flex-shrink: 0;
      border-top-right-radius: 1rem;
      border-bottom-right-radius: 1rem;
    }
    #contentWrapper {
      transition: margin-left 0.3s ease, width 0.3s ease;
      width: 100%;
      margin-left: 0;
      max-width: 100vw;
      box-sizing: border-box;
    }
    #contentWrapper.sidebar-open {
      margin-left: 240px;
      width: calc(100% - 240px);
      max-width: calc(100vw - 240px);
    }
    /* Stronger visible borders for tables and containers */
    table, th, td {
      border: 2px solid #4a5a4a !important;
    }
    table {
      border-collapse: separate !important;
      border-spacing: 0 !important;
      border-radius: 0.75rem;
      overflow: hidden;
    }
    thead tr {
      background-color: #d1e7dd !important;
      border-bottom: 3px solid #4a5a4a !important;
    }
    tbody tr {
      border-bottom: 2px solid #4a5a4a !important;
    }
    tbody tr:last-child {
      border-bottom: none !important;
    }
    /* Cards and sections with distinct borders and shadows */
    section > div.bg-white {
      border: 2px solid #4a5a4a;
      box-shadow: 0 8px 20px rgba(74, 90, 74, 0.25);
      border-radius: 1rem;
    }
    /* Doughnut chart container border */
    #sectionStatistics div.bg-gradient-to-br {
      border: 2px solid #4a5a4a;
      box-shadow: 0 8px 20px rgba(74, 90, 74, 0.25);
      border-radius: 1rem;
    }
    /* Dashboard cards border */
    #sectionDashboard > div.grid > div {
      border: 2px solid rgba(255 255 255 / 0.6);
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }
    /* Recent transactions container border */
    #sectionDashboard > div.bg-white {
      border: 2px solid #4a5a4a;
      box-shadow: 0 8px 20px rgba(74, 90, 74, 0.25);
      border-radius: 1rem;
    }
  </style>
 </head>
 <body class="min-h-screen bg-gradient-to-tr from-[#4a6a5a] via-[#5a7a6a] to-[#6a8a7a] flex">
  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 h-full bg-[#e6eee7] p-8 md:pt-12 md:pb-12 md:px-8 flex flex-col select-none transform -translate-x-full z-50" id="sidebar">
   <h1 class="text-[#1a2a1a] font-semibold text-lg mb-8 select-none">
    UMKM Helm &amp; Cuci Helm
   </h1>
   <nav class="flex flex-col gap-4 text-[#6b7a6b] text-sm font-medium">
    <button class="flex items-center gap-3 bg-[#1a2a1a] text-white rounded-lg py-2 px-6 w-full cursor-pointer" id="navDashboard">
     <i class="fas fa-th-large text-xs">
     </i>
     Dashboard
    </button>
    <button class="flex items-center gap-3 hover:text-[#a0b0a0] rounded-lg py-2 px-6 w-full cursor-pointer" id="navReport">
     <i class="fas fa-file-alt text-xs">
     </i>
     Report
    </button>
    <button class="flex items-center gap-3 hover:text-[#a0b0a0] rounded-lg py-2 px-6 w-full cursor-pointer" id="navStatistics">
     <i class="fas fa-chart-bar text-xs">
     </i>
     Statistics
    </button>
    <button class="flex items-center gap-3 hover:text-[#a0b0a0] rounded-lg py-2 px-6 w-full cursor-pointer" id="navArticles">
     <i class="fas fa-newspaper text-xs">
     </i>
     Articles
    </button>
   </nav>
   <div class="mt-auto bg-[#1a2a1a] rounded-none p-6 text-white flex flex-col items-center text-center" style="border-bottom-right-radius: 1rem;">
    <div class="text-sm font-semibold mb-1 flex items-center justify-center gap-1">
     Get Premium
     <i class="fas fa-star text-yellow-400">
     </i>
    </div>
    <div class="text-[10px] mb-3 leading-[1.1]">
     Unlimited transfer and
     <br/>
     statistics memory
    </div>
    <button class="bg-[#f9fdf8] text-[#1a2a1a] text-[10px] font-semibold rounded-full py-1 px-6 w-[90px] hover:bg-[#d9e6d9] transition">
     Upgrade
    </button>
   </div>
  </aside>
  <!-- Overlay -->
  <div class="fixed inset-0 bg-black bg-opacity-30 hidden z-40 md:hidden" id="overlay">
  </div>
  <!-- Main content container -->
  <div class="flex-1 w-full min-h-screen bg-[#f9fdf8] rounded-none p-6 md:p-10 flex flex-col gap-6 max-w-full overflow-auto relative z-10 transition-filter duration-300 ease-in-out" id="contentWrapper">
   <!-- Single toggle button for all pages -->
   <button aria-label="Toggle sidebar" class="mb-4 bg-[#1a2a1a] text-white p-2 rounded-md w-10 h-10 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#a0b0a0]" id="sidebarToggleMain" title="Toggle Sidebar">
    <i class="fas fa-bars">
    </i>
   </button>
   <!-- Dashboard Section -->
   <section class="block max-w-6xl mx-auto w-full" id="sectionDashboard">
    <h2 class="text-[#1a2a1a] font-semibold text-xl mb-6 select-none text-center">
     Dashboard Overview
    </h2>
    <!-- Accumulation Income & Outcome -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
     <div class="bg-gradient-to-br from-[#0a2a1a] via-[#0f3a2a] to-[#1a4a3a] rounded-[20px] p-6 text-white select-none flex flex-col justify-center items-center shadow-lg shadow-green-900/50 border-2 border-green-700">
      <div class="text-xs font-semibold mb-2 tracking-wide uppercase">
       Total Income
      </div>
      <div class="text-4xl font-extrabold leading-[1.1]" id="dashboardIncome">
       Rp0
      </div>
      <div class="text-[10px] mt-3 text-[#a0b0a0] flex items-center gap-1">
       <i class="fas fa-arrow-down text-green-400 animate-bounce">
       </i>
       Money coming in
      </div>
     </div>
     <div class="bg-gradient-to-br from-[#4a1a1a] via-[#6a1a1a] to-[#8a1a1a] rounded-[20px] p-6 text-white select-none flex flex-col justify-center items-center shadow-lg shadow-red-900/50 border-2 border-red-700">
      <div class="text-xs font-semibold mb-2 tracking-wide uppercase">
       Total Outcome
      </div>
      <div class="text-4xl font-extrabold leading-[1.1]" id="dashboardOutcome">
       Rp0
      </div>
      <div class="text-[10px] mt-3 text-[#a0a0a0] flex items-center gap-1">
       <i class="fas fa-arrow-up text-red-400 animate-pulse">
       </i>
       Money going out
      </div>
     </div>
    </div>
    <!-- Recent Transactions List -->
    <div class="bg-white rounded-lg p-6 shadow-md max-w-full max-h-[400px] overflow-y-auto border-2 border-[#4a5a4a]">
     <h3 class="text-lg font-semibold mb-4 text-[#1a2a1a] border-b-2 border-[#4a5a4a] pb-2">
      Recent Transactions
     </h3>
     <ul class="divide-y divide-gray-300" id="dashboardTransactionList">
     </ul>
    </div>
   </section>
   <!-- Report Section -->
   <section class="hidden max-w-4xl mx-auto w-full" id="sectionReport">
    <h2 class="text-[#1a2a1a] font-semibold text-xl mb-6 select-none text-center">
     Monthly Financial Report
    </h2>
    <form class="bg-gradient-to-r from-green-100 to-green-200 rounded-xl p-8 shadow-lg max-w-md mx-auto mb-8 border-2 border-green-600" id="transactionForm">
     <div class="mb-5">
      <label class="block text-sm font-semibold text-green-900 mb-2" for="type">
       Type
      </label>
      <select class="w-full border border-green-600 rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-700 bg-green-50 text-green-900" id="type" required="">
       <option value="income">
        Income
       </option>
       <option value="expense">
        Expense
       </option>
      </select>
     </div>
     <div class="mb-5">
      <label class="block text-sm font-semibold text-green-900 mb-2" for="category">
       Category
      </label>
      <select class="w-full border border-green-600 rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-700 bg-green-50 text-green-900" id="category" required="">
       <optgroup label="Income Categories">
        <option value="Penjualan Helm">
         Penjualan Helm
        </option>
        <option value="Jasa Cuci Helm">
         Jasa Cuci Helm
        </option>
        <option value="Lainnya">
         Lainnya
        </option>
       </optgroup>
       <optgroup label="Expense Categories">
        <option value="Bahan Pembersih">
         Bahan Pembersih
        </option>
        <option value="Gaji Karyawan">
         Gaji Karyawan
        </option>
        <option value="Perawatan Helm">
         Perawatan Helm
        </option>
        <option value="Listrik &amp; Air">
         Listrik &amp; Air
        </option>
        <option value="Lainnya">
         Lainnya
        </option>
       </optgroup>
      </select>
     </div>
     <div class="mb-5">
      <label class="block text-sm font-semibold text-green-900 mb-2" for="amount">
       Amount (Rp)
      </label>
      <input class="w-full border border-green-600 rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-700 bg-green-50 text-green-900" id="amount" min="0.01" placeholder="0" required="" step="0.01" type="number"/>
     </div>
     <div class="mb-6">
      <label class="block text-sm font-semibold text-green-900 mb-2" for="date">
       Date
      </label>
      <input class="w-full border border-green-600 rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-green-700 bg-green-50 text-green-900" id="date" required="" type="date"/>
     </div>
     <button class="w-full bg-green-700 text-white font-semibold py-3 rounded-lg hover:bg-green-800 transition" type="submit">
      Add Transaction
     </button>
    </form>
    <div class="bg-white rounded-lg p-6 shadow-md overflow-x-auto border-2 border-[#4a5a4a]">
     <h3 class="text-lg font-semibold mb-4 text-[#1a2a1a] text-center border-b-2 border-[#4a5a4a] pb-2">
      Transactions
     </h3>
     <table class="w-full text-left text-sm text-[#4a5a4a] border-collapse border border-[#4a5a4a] rounded-lg">
      <thead>
       <tr class="bg-green-100 border-b-2 border-[#4a5a4a]">
        <th class="py-3 px-4 border-r-2 border-[#4a5a4a]">
         Date
        </th>
        <th class="py-3 px-4 border-r-2 border-[#4a5a4a]">
         Type
        </th>
        <th class="py-3 px-4 border-r-2 border-[#4a5a4a]">
         Category
        </th>
        <th class="py-3 px-4">
         Amount (Rp)
        </th>
       </tr>
      </thead>
      <tbody id="transactionsTableBody">
      </tbody>
     </table>
     <div class="mt-6 flex flex-col md:flex-row justify-end gap-8 text-[#1a2a1a] font-semibold text-right border-t-2 border-[#4a5a4a] pt-4">
      <div>
       Total Income:
       <span id="totalIncome">
        Rp0
       </span>
      </div>
      <div>
       Total Expense:
       <span id="totalExpense">
        Rp0
       </span>
      </div>
      <div>
       Balance:
       <span id="balance">
        Rp0
       </span>
      </div>
     </div>
    </div>
   </section>
   <!-- Statistics Section -->
   <section class="hidden max-w-6xl mx-auto w-full" id="sectionStatistics">
    <h2 class="text-[#1a2a1a] font-semibold text-3xl mb-8 select-none text-center tracking-wide">
     Financial Statistics &amp; Analysis
    </h2>
    <div class="bg-white rounded-xl p-8 shadow-xl max-w-full border-2 border-[#4a5a4a]">
     <h3 class="text-2xl font-bold mb-6 text-[#1a2a1a] text-center tracking-tight border-b-2 border-[#4a5a4a] pb-4">
      Monthly Summary
     </h3>
     <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
      <div class="p-6 bg-gradient-to-tr from-green-200 to-green-400 rounded-2xl text-green-900 shadow-lg flex flex-col items-center justify-center transform hover:scale-105 transition-transform duration-300 border-2 border-green-700">
       <div class="flex items-center gap-3 mb-3">
        <i class="fas fa-wallet fa-2x">
        </i>
        <h4 class="font-semibold text-lg">
         Total Income
        </h4>
       </div>
       <p class="text-3xl font-extrabold" id="statIncome">
        Rp0
       </p>
       <img alt="Decorative green upward arrow icon representing income growth" class="mt-4 w-16 h-16 opacity-30" height="64" src="https://storage.googleapis.com/a1aa/image/c90fb311-e10b-4641-ebb8-0f0e7a0538ec.jpg" width="64"/>
      </div>
      <div class="p-6 bg-gradient-to-tr from-red-200 to-red-400 rounded-2xl text-red-900 shadow-lg flex flex-col items-center justify-center transform hover:scale-105 transition-transform duration-300 border-2 border-red-700">
       <div class="flex items-center gap-3 mb-3">
        <i class="fas fa-credit-card fa-2x">
        </i>
        <h4 class="font-semibold text-lg">
         Total Expense
        </h4>
       </div>
       <p class="text-3xl font-extrabold" id="statExpense">
        Rp0
       </p>
       <img alt="Decorative red downward arrow icon representing expense" class="mt-4 w-16 h-16 opacity-30" height="64" src="https://storage.googleapis.com/a1aa/image/7397f4f2-3534-4a80-f157-a52fb7509b06.jpg" width="64"/>
      </div>
      <div class="p-6 bg-gradient-to-tr from-blue-200 to-blue-400 rounded-2xl text-blue-900 shadow-lg flex flex-col items-center justify-center transform hover:scale-105 transition-transform duration-300 border-2 border-blue-700">
       <div class="flex items-center gap-3 mb-3">
        <i class="fas fa-balance-scale fa-2x">
        </i>
        <h4 class="font-semibold text-lg">
         Balance
        </h4>
       </div>
       <p class="text-3xl font-extrabold" id="statBalance">
        Rp0
       </p>
       <img alt="Decorative blue balance scale icon representing financial balance" class="mt-4 w-16 h-16 opacity-30" height="64" src="https://storage.googleapis.com/a1aa/image/9faa2418-969c-4218-d9d2-b68ff46d28eb.jpg" width="64"/>
      </div>
     </div>
     <h3 class="text-2xl font-bold mb-6 text-[#1a2a1a] text-center tracking-tight border-b-2 border-[#4a5a4a] pb-4">
      Expense by Category
     </h3>
     <div class="mb-12 rounded-xl shadow-lg p-6 bg-gradient-to-br from-red-50 to-red-100 border-2 border-[#4a5a4a]">
      <canvas class="w-full h-72 rounded-xl" id="expenseChartCanvas">
      </canvas>
     </div>
     <h3 class="text-2xl font-bold mb-6 text-[#1a2a1a] text-center tracking-tight border-b-2 border-[#4a5a4a] pb-4">
      Income by Category
     </h3>
     <div class="rounded-xl shadow-lg p-6 bg-gradient-to-br from-green-50 to-green-100 border-2 border-[#4a5a4a] mb-12">
      <canvas class="w-full h-72 rounded-xl" id="incomeChartCanvas">
      </canvas>
     </div>
     <h3 class="text-2xl font-bold mb-6 text-[#1a2a1a] text-center tracking-tight border-b-2 border-[#4a5a4a] pb-4">
      Income &amp; Outcome Over Time
     </h3>
     <div class="flex flex-col md:flex-row items-center justify-center gap-6 mb-6 max-w-md mx-auto">
      <label for="timeRange" class="font-semibold text-[#1a2a1a]">View by:</label>
      <select id="timeRange" class="border border-[#4a5a4a] rounded-lg px-4 py-2 text-[#1a2a1a] focus:outline-none focus:ring-2 focus:ring-[#4a5a4a]">
       <option value="month" selected>Monthly</option>
       <option value="year">Yearly</option>
      </select>
     </div>
     <div class="rounded-xl shadow-lg p-6 bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-[#4a5a4a]">
      <canvas class="w-full h-80 rounded-xl" id="incomeOutcomeChartCanvas">
      </canvas>
     </div>
    </div>
   </section>
   <!-- Articles Section -->
   <section class="hidden max-w-6xl mx-auto w-full" id="sectionArticles">
    <h2 class="text-[#1a2a1a] font-semibold text-2xl mb-8 select-none text-center">
     Financial Management Articles for UMKM Helm &amp; Cuci Helm
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
     <article class="bg-white rounded-lg shadow-md p-6 flex flex-col border-2 border-[#4a5a4a]">
      <img alt="Illustration of a small business owner planning finances with charts and notes on a desk" class="rounded-lg mb-4 w-full object-cover h-48" height="300" src="https://storage.googleapis.com/a1aa/image/92431ef4-afe5-46df-7c1c-8dee7f85bf88.jpg" width="600"/>
      <h3 class="text-xl font-semibold mb-2 text-[#1a2a1a]">
       Financial Planning for UMKM Helm &amp; Cuci Helm
      </h3>
      <p class="text-gray-700 flex-grow">
       Pelajari cara membuat perencanaan keuangan yang efektif untuk bisnis helm dan jasa cuci helm Anda agar dapat mengelola arus kas dan investasi dengan baik.
      </p>
      <a class="mt-4 text-green-700 font-semibold hover:underline self-start" href="#">
       Read More
      </a>
     </article>
     <article class="bg-white rounded-lg shadow-md p-6 flex flex-col border-2 border-[#4a5a4a]">
      <img alt="Illustration of cash flow management with money and calendar icons" class="rounded-lg mb-4 w-full object-cover h-48" height="300" src="https://storage.googleapis.com/a1aa/image/6c73bbad-3cc8-4f45-b868-fcf9add7d953.jpg" width="600"/>
      <h3 class="text-xl font-semibold mb-2 text-[#1a2a1a]">
       Managing Cash Flow in Your Helm Business
      </h3>
      <p class="text-gray-700 flex-grow">
       Tips dan trik mengelola arus kas agar bisnis helm dan cuci helm Anda tetap sehat dan mampu menghadapi tantangan keuangan sehari-hari.
      </p>
      <a class="mt-4 text-green-700 font-semibold hover:underline self-start" href="#">
       Read More
      </a>
     </article>
     <article class="bg-white rounded-lg shadow-md p-6 flex flex-col border-2 border-[#4a5a4a]">
      <img alt="Illustration of cost control with calculator and budget sheets" class="rounded-lg mb-4 w-full object-cover h-48" height="300" src="https://storage.googleapis.com/a1aa/image/b983eac8-f7a7-4c09-41ba-0df39fc8a894.jpg" width="600"/>
      <h3 class="text-xl font-semibold mb-2 text-[#1a2a1a]">
       Cost Control Strategies for UMKM
      </h3>
      <p class="text-gray-700 flex-grow">
       Pelajari strategi pengendalian biaya yang dapat membantu bisnis helm dan cuci helm Anda meningkatkan profitabilitas tanpa mengurangi kualitas layanan.
      </p>
      <a class="mt-4 text-green-700 font-semibold hover:underline self-start" href="#">
       Read More
      </a>
     </article>
     <article class="bg-white rounded-lg shadow-md p-6 flex flex-col border-2 border-[#4a5a4a]">
      <img alt="Illustration of marketing budget planning with charts and money" class="rounded-lg mb-4 w-full object-cover h-48" height="300" src="https://storage.googleapis.com/a1aa/image/4dde4880-7185-4aa0-96e2-00dc16b05486.jpg" width="600"/>
      <h3 class="text-xl font-semibold mb-2 text-[#1a2a1a]">
       Marketing Budget Tips for Small Businesses
      </h3>
      <p class="text-gray-700 flex-grow">
       Cara mengalokasikan anggaran pemasaran secara efektif untuk meningkatkan penjualan helm dan jasa cuci helm Anda tanpa membebani keuangan.
      </p>
      <a class="mt-4 text-green-700 font-semibold hover:underline self-start" href="#">
       Read More
      </a>
     </article>
     <article class="bg-white rounded-lg shadow-md p-6 flex flex-col border-2 border-[#4a5a4a]">
      <img alt="Illustration of saving and investment with piggy bank and coins" class="rounded-lg mb-4 w-full object-cover h-48" height="300" src="https://storage.googleapis.com/a1aa/image/86dec276-86d9-4b27-31ab-9dba883557f4.jpg" width="600"/>
      <h3 class="text-xl font-semibold mb-2 text-[#1a2a1a]">
       Saving and Investment for UMKM Owners
      </h3>
      <p class="text-gray-700 flex-grow">
       Panduan menabung dan berinvestasi untuk pemilik UMKM helm dan cuci helm agar bisnis dan keuangan pribadi tetap berkembang.
      </p>
      <a class="mt-4 text-green-700 font-semibold hover:underline self-start" href="#">
       Read More
      </a>
     </article>
     <article class="bg-white rounded-lg shadow-md p-6 flex flex-col border-2 border-[#4a5a4a]">
      <img alt="Illustration of debt management with documents and calculator" class="rounded-lg mb-4 w-full object-cover h-48" height="300" src="https://storage.googleapis.com/a1aa/image/e89870a2-710d-4dae-9d82-9a556dad39c7.jpg" width="600"/>
      <h3 class="text-xl font-semibold mb-2 text-[#1a2a1a]">
       Effective Debt Management for Small Businesses
      </h3>
      <p class="text-gray-700 flex-grow">
       Tips mengelola hutang usaha agar bisnis helm dan cuci helm Anda tetap sehat dan terhindar dari masalah keuangan.
      </p>
      <a class="mt-4 text-green-700 font-semibold hover:underline self-start" href="#">
       Read More
      </a>
     </article>
    </div>
   </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js">
  </script>
  <script>
   const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const toggleSidebarMain = document.getElementById("sidebarToggleMain");
    const contentWrapper = document.getElementById("contentWrapper");

    const navDashboard = document.getElementById("navDashboard");
    const navReport = document.getElementById("navReport");
    const navStatistics = document.getElementById("navStatistics");
    const navArticles = document.getElementById("navArticles");
    const sectionDashboard = document.getElementById("sectionDashboard");
    const sectionReport = document.getElementById("sectionReport");
    const sectionStatistics = document.getElementById("sectionStatistics");
    const sectionArticles = document.getElementById("sectionArticles");

    let transactions = [];

    const transactionForm = document.getElementById("transactionForm");
    const transactionsTableBody = document.getElementById("transactionsTableBody");
    const totalIncomeEl = document.getElementById("totalIncome");
    const totalExpenseEl = document.getElementById("totalExpense");
    const balanceEl = document.getElementById("balance");

    const dashboardIncomeEl = document.getElementById("dashboardIncome");
    const dashboardOutcomeEl = document.getElementById("dashboardOutcome");
    const dashboardTransactionList = document.getElementById("dashboardTransactionList");

    const statIncome = document.getElementById("statIncome");
    const statExpense = document.getElementById("statExpense");
    const statBalance = document.getElementById("statBalance");
    const expenseCategoryChartEl = document.getElementById("expenseCategoryChart");
    const incomeCategoryChartEl = document.getElementById("incomeCategoryChart");
    const incomeOutcomeChartCanvas = document.getElementById("incomeOutcomeChartCanvas");
    const timeRangeSelect = document.getElementById("timeRange");

    let expenseChart, incomeChart, incomeOutcomeChart;

    // Format number to Indonesian Rupiah currency string
    function formatRupiah(value) {
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
    }

    // Sidebar toggle functions
    function openSidebar() {
      sidebar.classList.remove("-translate-x-full");
      overlay.classList.remove("hidden");
      contentWrapper.classList.add("sidebar-open");
    }

    function closeSidebar() {
      sidebar.classList.add("-translate-x-full");
      overlay.classList.add("hidden");
      contentWrapper.classList.remove("sidebar-open");
    }

    function toggleSidebar() {
      if (sidebar.classList.contains("-translate-x-full")) {
        openSidebar();
      } else {
        closeSidebar();
      }
    }

    toggleSidebarMain.addEventListener("click", toggleSidebar);
    overlay.addEventListener("click", closeSidebar);

    // Navigation between pages
    function setActiveNav(activeNav) {
      [navDashboard, navReport, navStatistics, navArticles].forEach((nav) => {
        nav.classList.remove("bg-[#1a2a1a]", "text-white");
      });
      activeNav.classList.add("bg-[#1a2a1a]", "text-white");
    }

    function navClickHandler(navButton, showSection) {
      navButton.addEventListener("click", () => {
        setActiveNav(navButton);
        sectionDashboard.classList.add("hidden");
        sectionReport.classList.add("hidden");
        sectionStatistics.classList.add("hidden");
        sectionArticles.classList.add("hidden");
        showSection.classList.remove("hidden");
        closeSidebar();
      });
    }

    navClickHandler(navDashboard, sectionDashboard);
    navClickHandler(navReport, sectionReport);
    navClickHandler(navStatistics, sectionStatistics);
    navClickHandler(navArticles, sectionArticles);

    // Initialize with Dashboard active
    navDashboard.click();

    // Add transaction handler
    transactionForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const type = transactionForm.type.value;
      const category = transactionForm.category.value;
      const amount = parseFloat(transactionForm.amount.value);
      const date = transactionForm.date.value;

      if (!category || !date || isNaN(amount) || amount <= 0) {
        alert("Please fill all fields correctly.");
        return;
      }

      transactions.push({ type, category, amount, date });
      transactionForm.reset();
      updateReportTable();
      updateStatistics();
      updateDashboard();
    });

    // Update report table and totals
    function updateReportTable() {
      transactionsTableBody.innerHTML = "";
      let totalIncome = 0;
      let totalExpense = 0;

      // Sort transactions by date descending
      const sorted = [...transactions].sort(
        (a, b) => new Date(b.date) - new Date(a.date)
      );

      for (const t of sorted) {
        const tr = document.createElement("tr");
        tr.classList.add("border-b", "border-gray-300");
        tr.innerHTML = `
          <td class="py-2 px-3">${t.date}</td>
          <td class="py-2 px-3 capitalize">${t.type}</td>
          <td class="py-2 px-3">${t.category}</td>
          <td class="py-2 px-3 ${
            t.type === "income" ? "text-green-600" : "text-red-600"
          } font-semibold">${formatRupiah(t.amount)}</td>
        `;
        transactionsTableBody.appendChild(tr);

        if (t.type === "income") totalIncome += t.amount;
        else totalExpense += t.amount;
      }

      totalIncomeEl.textContent = formatRupiah(totalIncome);
      totalExpenseEl.textContent = formatRupiah(totalExpense);
      balanceEl.textContent = formatRupiah(totalIncome - totalExpense);
    }

    // Update statistics charts and summary
    function updateStatistics() {
      // Calculate totals
      let totalIncome = 0;
      let totalExpense = 0;
      const incomeByCategory = {};
      const expenseByCategory = {};

      for (const t of transactions) {
        if (t.type === "income") {
          totalIncome += t.amount;
          incomeByCategory[t.category] =
            (incomeByCategory[t.category] || 0) + t.amount;
        } else {
          totalExpense += t.amount;
          expenseByCategory[t.category] =
            (expenseByCategory[t.category] || 0) + t.amount;
        }
      }

      statIncome.textContent = formatRupiah(totalIncome);
      statExpense.textContent = formatRupiah(totalExpense);
      statBalance.textContent = formatRupiah(totalIncome - totalExpense);

      // Prepare data for charts
      const expenseLabels = Object.keys(expenseByCategory);
      const expenseData = Object.values(expenseByCategory);

      const incomeLabels = Object.keys(incomeByCategory);
      const incomeData = Object.values(incomeByCategory);

      // Clear previous charts if exist
      if (expenseChart) expenseChart.destroy();
      if (incomeChart) incomeChart.destroy();

      // Create expense category chart
      const ctxExpense = document.getElementById("expenseChartCanvas").getContext("2d");
      expenseChart = new Chart(ctxExpense, {
        type: "doughnut",
        data: {
          labels: expenseLabels,
          datasets: [
            {
              label: "Expenses",
              data: expenseData,
              backgroundColor: [
                "#f87171",
                "#fbbf24",
                "#34d399",
                "#60a5fa",
                "#a78bfa",
                "#f472b6",
              ],
              borderColor: "#fff",
              borderWidth: 3,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: "70%",
          plugins: {
            legend: { position: "bottom", labels: { padding: 20, boxWidth: 22, font: { size: 15, weight: "700" } } },
            title: {
              display: true,
              text: "Expenses by Category",
              font: { size: 20, weight: "800" },
              padding: { bottom: 25 }
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  let label = context.label || '';
                  let value = context.parsed || 0;
                  return label + ': ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                }
              }
            }
          },
          animation: {
            animateRotate: true,
            animateScale: true
          }
        },
      });

      // Create income category chart
      const ctxIncome = document.getElementById("incomeChartCanvas").getContext("2d");
      incomeChart = new Chart(ctxIncome, {
        type: "doughnut",
        data: {
          labels: incomeLabels,
          datasets: [
            {
              label: "Income",
              data: incomeData,
              backgroundColor: [
                "#34d399",
                "#60a5fa",
                "#a78bfa",
                "#fbbf24",
                "#f87171",
                "#f472b6",
              ],
              borderColor: "#fff",
              borderWidth: 3,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: "70%",
          plugins: {
            legend: { position: "bottom", labels: { padding: 20, boxWidth: 22, font: { size: 15, weight: "700" } } },
            title: {
              display: true,
              text: "Income by Category",
              font: { size: 20, weight: "800" },
              padding: { bottom: 25 }
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  let label = context.label || '';
                  let value = context.parsed || 0;
                  return label + ': ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                }
              }
            }
          },
          animation: {
            animateRotate: true,
            animateScale: true
          }
        },
      });

      updateIncomeOutcomeChart();
    }

    // Update dashboard income, outcome, recent transactions
    function updateDashboard() {
      let totalIncome = 0;
      let totalOutcome = 0;

      // Calculate totals
      for (const t of transactions) {
        if (t.type === "income") totalIncome += t.amount;
        else totalOutcome += t.amount;
      }

      dashboardIncomeEl.textContent = formatRupiah(totalIncome);
      dashboardOutcomeEl.textContent = formatRupiah(totalOutcome);

      // Update recent transactions list (show latest 7)
      dashboardTransactionList.innerHTML = "";
      const sorted = [...transactions].sort(
        (a, b) => new Date(b.date) - new Date(a.date)
      );
      const recent = sorted.slice(0, 7);
      for (const t of recent) {
        const li = document.createElement("li");
        li.className = "py-2 flex justify-between items-center";
        li.innerHTML = `
          <div>
            <div class="font-semibold text-sm text-[#1a2a1a]">${t.category}</div>
            <div class="text-[10px] text-gray-500">${t.date}</div>
          </div>
          <div class="${
            t.type === "income" ? "text-green-600" : "text-red-600"
          } font-semibold">${formatRupiah(t.amount)}</div>
        `;
        dashboardTransactionList.appendChild(li);
      }
    }

    // Prepare data for income/outcome over time chart
    function prepareIncomeOutcomeData(range) {
      // range: "month" or "year"
      // Group transactions by month or year
      const grouped = {};

      transactions.forEach(t => {
        const dateObj = new Date(t.date);
        let key;
        if (range === "month") {
          // Format: YYYY-MM
          const month = (dateObj.getMonth() + 1).toString().padStart(2, "0");
          key = `${dateObj.getFullYear()}-${month}`;
        } else {
          // Year only
          key = `${dateObj.getFullYear()}`;
        }
        if (!grouped[key]) {
          grouped[key] = { income: 0, expense: 0 };
        }
        if (t.type === "income") {
          grouped[key].income += t.amount;
        } else {
          grouped[key].expense += t.amount;
        }
      });

      // Sort keys ascending
      const keys = Object.keys(grouped).sort();

      // Prepare labels and datasets
      const labels = keys;
      const incomeData = keys.map(k => grouped[k].income);
      const expenseData = keys.map(k => grouped[k].expense);

      return { labels, incomeData, expenseData };
    }

    // Update income/outcome over time chart
    function updateIncomeOutcomeChart() {
      const range = timeRangeSelect.value;
      const { labels, incomeData, expenseData } = prepareIncomeOutcomeData(range);

      if (incomeOutcomeChart) incomeOutcomeChart.destroy();

      incomeOutcomeChart = new Chart(incomeOutcomeChartCanvas.getContext("2d"), {
        type: "line",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Income",
              data: incomeData,
              borderColor: "#34d399",
              backgroundColor: "rgba(52, 211, 153, 0.3)",
              fill: true,
              tension: 0.3,
              pointRadius: 4,
              pointHoverRadius: 6,
              borderWidth: 3,
            },
            {
              label: "Outcome",
              data: expenseData,
              borderColor: "#f87171",
              backgroundColor: "rgba(248, 113, 113, 0.3)",
              fill: true,
              tension: 0.3,
              pointRadius: 4,
              pointHoverRadius: 6,
              borderWidth: 3,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          interaction: {
            mode: 'nearest',
            intersect: false,
          },
          plugins: {
            legend: {
              position: "top",
              labels: {
                font: { size: 14, weight: "600" },
                padding: 20,
              }
            },
            title: {
              display: false,
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return context.dataset.label + ': ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                }
              }
            }
          },
          scales: {
            x: {
              title: {
                display: true,
                text: range === "month" ? "Month (YYYY-MM)" : "Year (YYYY)",
                font: { size: 14, weight: "600" }
              },
              ticks: {
                maxRotation: 45,
                minRotation: 45,
                maxTicksLimit: 12,
                font: { size: 12 }
              },
              grid: {
                display: false,
              }
            },
            y: {
              title: {
                display: true,
                text: "Amount (Rp)",
                font: { size: 14, weight: "600" }
              },
              ticks: {
                font: { size: 12 },
                callback: function(value) {
                  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                }
              },
              grid: {
                color: "#e0e0e0",
                borderDash: [5, 5],
              },
              beginAtZero: true,
            }
          }
        }
      });
    }

    // Update dashboard income, outcome, recent transactions
    function updateDashboard() {
      let totalIncome = 0;
      let totalOutcome = 0;

      // Calculate totals
      for (const t of transactions) {
        if (t.type === "income") totalIncome += t.amount;
        else totalOutcome += t.amount;
      }

      dashboardIncomeEl.textContent = formatRupiah(totalIncome);
      dashboardOutcomeEl.textContent = formatRupiah(totalOutcome);

      // Update recent transactions list (show latest 7)
      dashboardTransactionList.innerHTML = "";
      const sorted = [...transactions].sort(
        (a, b) => new Date(b.date) - new Date(a.date)
      );
      const recent = sorted.slice(0, 7);
      for (const t of recent) {
        const li = document.createElement("li");
        li.className = "py-2 flex justify-between items-center";
        li.innerHTML = `
          <div>
            <div class="font-semibold text-sm text-[#1a2a1a]">${t.category}</div>
            <div class="text-[10px] text-gray-500">${t.date}</div>
          </div>
          <div class="${
            t.type === "income" ? "text-green-600" : "text-red-600"
          } font-semibold">${formatRupiah(t.amount)}</div>
        `;
        dashboardTransactionList.appendChild(li);
      }
    }

    // On window resize, reset sidebar and overlay for desktop and adjust content width
    function handleResize() {
      if (window.innerWidth >= 768) {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.add("hidden");
        contentWrapper.classList.add("sidebar-open");
      } else {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
        contentWrapper.classList.remove("sidebar-open");
      }
    }

    window.addEventListener("resize", () => {
      handleResize();
      if (expenseChart) expenseChart.resize();
      if (incomeChart) incomeChart.resize();
      if (incomeOutcomeChart) incomeOutcomeChart.resize();
    });

    // Initialize sidebar state on load
    handleResize();

    // Initialize dashboard with empty data
    updateDashboard();

    // Update statistics and charts on data change
    function updateAll() {
      updateReportTable();
      updateStatistics();
      updateDashboard();
      updateIncomeOutcomeChart();
    }

    // Override updateStatistics to call updateIncomeOutcomeChart as well
    transactionForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const type = transactionForm.type.value;
      const category = transactionForm.category.value;
      const amount = parseFloat(transactionForm.amount.value);
      const date = transactionForm.date.value;

      if (!category || !date || isNaN(amount) || amount <= 0) {
        alert("Please fill all fields correctly.");
        return;
      }

      transactions.push({ type, category, amount, date });
      transactionForm.reset();
      updateAll();
    });

    // Also update incomeOutcomeChart when timeRange changes
    timeRangeSelect.addEventListener("change", () => {
      updateIncomeOutcomeChart();
    });

  </script>
 </body>
</html>