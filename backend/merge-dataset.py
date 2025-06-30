# import pandas as pd

# # Load the uploaded dataset
# file_path = "data_core.csv"
# df = pd.read_csv(file_path)

# # Updated crop to season mapping with multiple seasons where applicable
# season_mapping = {
#     "Rice": ["Kharif"],
#     "Wheat": ["Rabi"],
#     "Maize": ["Kharif", "Rabi","Summer"],
#     "Cotton": ["Kharif"],
#     "Soybean": ["Kharif"],
#     "Potato": ["Rabi"],
#     "Tomato": ["Zaid", "Kharif","Rabi","Summer"],
#     "Carrot": ["Rabi"],
#     "Barley": ["Rabi","Kharif","Zaid","Summer"],
#     "Groundnut": ["Kharif", "Rabi","Summer"],
#     "Bajra": ["Kharif","Rabi","Summer","Zaid"],
#     "Mustard": ["Rabi"],
#     "Pulses": ["Rabi", "Kharif"],
#     "Onion": ["Kharif", "Rabi", "Zaid","Summer"],
#     "Chillies": ["Kharif", "Rabi","Zaid","Summer"],
#     "Peas": ["Rabi"],
#     "Jowar": ["Kharif", "Rabi","Summer","Zaid"],
#     "Sunflower": ["Kharif", "Rabi","Summer","Zaid"],
#     "Garlic": ["Kharif", "Rabi","Summer","Zaid"],
#     "Cabbage": ["Rabi", "Zaid"],
#     "Cauliflower": ["Rabi", "Zaid"],
#     "Brinjal": ["Zaid", "Kharif","Rabi"],
#     "Turmeric": ["Kharif","Rabi"],
#     "Ginger": ["Kharif","Rabi"]
# }

# # Map crops to seasons (joining season list into comma-separated string)
# df['Suitable Season'] = df['Crop Type'].map(lambda x: ", ".join(season_mapping[x]) if x in season_mapping else None)

# # Remove rows with crops not in the mapping
# df_cleaned = df.dropna(subset=['Suitable Season'])

# # Save to CSV
# output_csv_path = "updated_crop_soil_dataset.csv"
# df_cleaned.to_csv(output_csv_path, index=False)

# output_csv_path



# For remove columns

import pandas as pd

# Step 1: Load the CSV file
df = pd.read_csv("updated_crop_soil_dataset.csv")  # Replace with your filename

# Step 2: Remove specific columns
columns_to_remove = ['Nitrogen','Potassium','Phosphorous','Fertilizer Name','Moisture']  # Replace with actual column names
df = df.drop(columns=columns_to_remove)

# Step 3: Save the modified CSV
df.to_csv("modified_dataset.csv", index=False)
