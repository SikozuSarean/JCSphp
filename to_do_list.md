[] - create subscript that opens in new window to show every poition the ONU duplicates are located in every time date report
 [] - izolate the duplicates fh.
[x] Creat script create_table_database_MAIN_filter.php
[]improve the duplicate query inspire from this:
WITH CTE_all as
(SELECT *
FROM attenuation_report
WHERE Time_stamp = "2022-08-30 19:26:00"
)
make first a cte then search in that cte
[X] After individual report is scapped and stored to database Redirect in to main filter page
[] Urgent fix function store_scrape_store_filter
[X] Urgent fix main_filter_new view