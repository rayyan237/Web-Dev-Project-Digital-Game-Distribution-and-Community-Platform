--query to add dummy download_url for all games

UPDATE games
SET download_url = 'https://drive.google.com/uc?id=view';

Update games 
set price = 9.99 
where price = 0.00;