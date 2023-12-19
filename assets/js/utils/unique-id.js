function uniqueID() {
  return `${Date.now()}${String(Math.ceil(Math.random() * 999999)).padStart(6, '0')}`;
}

export { uniqueID };
