import { createServer } from 'node:http';
import { readFile, stat } from 'node:fs/promises';
import { extname, join, normalize } from 'node:path';

const root = join(process.cwd(), 'public');
const preferredPort = Number(process.env.PORT || 5173);
const host = process.env.HOST || '127.0.0.1';
const types = {
  '.html': 'text/html; charset=utf-8',
  '.css': 'text/css; charset=utf-8',
  '.js': 'text/javascript; charset=utf-8',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.png': 'image/png',
  '.webp': 'image/webp',
  '.svg': 'image/svg+xml',
};

const server = createServer(async (request, response) => {
  try {
    const url = new URL(request.url, `http://${request.headers.host || host}`);
    let pathname = decodeURIComponent(url.pathname);
    if (pathname === '/') pathname = '/preview/index.html';
    const filePath = normalize(join(root, pathname));

    if (!filePath.startsWith(root)) throw new Error('Invalid path');
    const info = await stat(filePath);
    if (!info.isFile()) throw new Error('Not a file');

    const body = await readFile(filePath);
    response.writeHead(200, {
      'Content-Type': types[extname(filePath).toLowerCase()] || 'application/octet-stream',
      'Cache-Control': 'no-store',
    });
    response.end(body);
  } catch {
    response.writeHead(404, { 'Content-Type': 'text/plain; charset=utf-8' });
    response.end('Not found');
  }
});

function listen(port) {
  server.once('error', (error) => {
    if (error.code === 'EADDRINUSE' && port < preferredPort + 20) {
      listen(port + 1);
      return;
    }
    throw error;
  });
  server.listen(port, host, () => {
    console.log(`Mare Ventus preview: http://${host}:${port}`);
  });
}

listen(preferredPort);
