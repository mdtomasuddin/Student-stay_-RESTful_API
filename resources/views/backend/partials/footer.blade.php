<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                © <span id="current-date"></span>
            </div>

            <script>
                const currentDate = new Date();
                const formattedDate = currentDate.toLocaleDateString('en-GB');
                const dateContainer = document.getElementById('current-date');
                if (dateContainer) {
                    dateContainer.textContent = formattedDate;
                }
            </script>

        </div>
    </div>
</footer>
