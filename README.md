# robusta

Task Description

We want you to help a company determine the dates they need to pay salaries to their
departments.

This company is handling their sales payroll in the following way:

● Sales staff gets a monthly fixed base salary and a monthly bonus(calculated as
10% of the base salary as default but the admin can change this percentage for
any employee).

● The base salaries are paid on the last day of the month unless that day is a
Friday or a Saturday (weekend) -> payday will be the last weekday before the
last day of the month.

● On the 15th of every month bonuses are paid for the previous month, unless
that day is a weekend. In that case: they are paid on the first Thursday after the
15th.

Requirements​:
1. Your API should have an endpoint that lists and filters the payment dates for the
remainder of this year with the corresponding amount to be paid each month,
sample of the output array should be like this:
{
Month: ‘Jan’,
Salaries_payment_day: 30,
Bonus_payment_day: 15,
Salaries_total: $20000,
Bonus_total: $2000,
Payments_total: $22000
}
2. Create the other endpoints you see needed to have a fully functional app
3. Only authenticated admins should use all API endpoints
4. Admins should receive reminder emails 2 days before any payment date with the
amount to be paid (salaries/bonus)


**The steps to run the project:**

- run migration.
- run seeder.
- login using this route to get api_token which will used in every routes after that:
 {site_url}/api/login | post | inputs (email, password).
- make sure that ther server run the cron jobs of laravel scheduling 


 **Routes**
 - all departments : {site_url}/api/departments | get | (api_token)
 - one department : {site_url}/departments/{department} | get | (api_token, id)
 - all employees : {site_url}/api/employees | get | (api_token)
 - update employee bonus : {site_url}/api/update_bonus | post | (api_token, id, bouns_by_ratio)
 - salaries report : {site_url}/api/salaries_report | get | (api_token)
 
 - fill reminder : {site_url}/api/fill_reminder | get | (api_token)
 - send mail to admins : {site_url}/api/send_mails | post | (api_token)