    <script>
        function toggleSidebar() {
            const sidebarContainer = document.querySelector('.sidebar-container');
            const mainContainer = document.querySelector('.main-container');
            sidebarContainer.classList.toggle('sidebr-collapsed');
            mainContainer.classList.toggle('sidebr-collapsed');
        }

        // Function to adjust the main-container height based on header height
        function adjustMainContainerHeight() {
            const headerHeight = document.getElementById('myHeader').clientHeight;
            const mainContainer = document.querySelector('.main-container');
            //mainContainer.style.marginTop = `${headerHeight}px`;
            mainContainer.style.maxHeight = `calc(100vh - ${headerHeight}px)`;
        }

        // Call the function initially when the page loads
        adjustMainContainerHeight();

        // Call the function whenever the window is resized to recalculate the header height
        window.addEventListener('resize', adjustMainContainerHeight);
    </script>
</body>
</html>