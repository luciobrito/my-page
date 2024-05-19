FROM node:21-alpine

WORKDIR /app
ENV NODE_OPTIONS=--max_old_space_size=2048
COPY package.json .

RUN npm install

COPY . .

RUN npm run build

EXPOSE 4173

CMD ["npm", "run", "preview", "--", "--host"]
