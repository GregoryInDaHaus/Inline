select lastname, firstname, max(age) 
from inline.person 
group by lastname