import sqlite3

conn = sqlite3.connect('answers.db')  # You can create a new database by changing the name within the quotes
c = conn.cursor() # The database will be saved in the location where your 'py' file is saved

# Create table - ANSWERS
c.execute('''CREATE TABLE ANSWERS
             ([generated_id] INTEGER PRIMARY KEY,[Username] text, [Task_Code] integer, [Question_Code] integer, [Answer_Score] integer, [Date] date)''')
                 
conn.commit()