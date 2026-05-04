-- Переименовать КНС
UPDATE pages SET title = 'Насосные станции поддержания давления' WHERE title LIKE '%Канализационные насосные станции%';

-- Если "Проектирование" уже есть как дочерняя — сделать топ-уровневой
UPDATE pages SET parent_id = NULL WHERE type = 'service' AND title LIKE '%Проектирование%' AND parent_id IS NOT NULL;
