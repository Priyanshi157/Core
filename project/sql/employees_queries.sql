SELECT * FROM departments;

SELECT * FROM employees.departments;

SELECT * FROM  employees WHERE gender = 'M';

SELECT * FROM employees WHERE first_name = 'Arif' AND last_name = 'Merlo';

SELECT * FROM dept_emp WHERE dept_no = 'd004' OR dept_no = 'd005';

SELECT * FROM dept_emp WHERE from_date > '1995-12-03';

SELECT * FROM titles WHERE title IN ('Senior Engineer' , 'staff');

SELECT * FROM title WHERE title NOT IN ('staff');

SELECT * FROM employees WHERE first_name LIKE 'ari%';

SELECT * FROM employees WHERE first_name NOT LIKE 'ari%';

SELECT * FROM employees WHERE first_name NOT LIKE '%a';

SELECT * FROM employees WHERE first_name LIKE '%a';

SELECT * FROM employees WHERE first_name LIKE 'ari_';

SELECT * FROM dept_emp WHERE from_date BETWEEN '2000-07-12' AND '2005-07-12';

SELECT * FROM employees WHERE last_name IS NULL;

SELECT * FROM employees WHERE last_name IS NOT NULL;

SELECT DISTINCT title FROM titles ;

SELECT COUNT(DISTINCT title) FROM titles ;