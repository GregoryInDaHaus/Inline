begin;
select @max_age := max(p.age) from inline.person p;
select concat( p.lastname, ' ', p.firstname ) as person_name, @person_id := id as id
from inline.person p 
where p.mother_id IS NULL and p.age < @max_age
limit 1;

update inline.person p
set p.age = @max_age
where id = @person_id;
end;